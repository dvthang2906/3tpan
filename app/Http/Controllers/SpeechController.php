<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender as V1SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\AudioEncoding as V1AudioEncoding;
use Exception;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
use Google\Cloud\Speech\V1\SpeechClient as V1SpeechClient;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SpeechController extends Controller
{
    protected $textToSpeechClient;
    protected $speechClient;
    protected $word;

    public function __construct()
    {
        $this->textToSpeechClient = new TextToSpeechClient([
            'credentials' => config('services.google_cloud.credentials'),
        ]);
        $this->speechClient = new V1SpeechClient([
            'credentials' => config('services.google_cloud.credentials'),
        ]);
    }

    public function synthesize(Request $request)
    {
        $this->word = $request->input('word');
        if (!$this->word) {
            return response()->json(['message' => 'Word is required'], 400);
        }

        $inputText = (new SynthesisInput())->setText($this->word);

        $voice = (new VoiceSelectionParams())
            ->setLanguageCode('ja-JP')
            ->setName('ja-JP-Wavenet-A')
            ->setSsmlGender(V1SsmlVoiceGender::NEUTRAL);

        $audioConfig = (new AudioConfig())
            ->setAudioEncoding(V1AudioEncoding::MP3);

        try {
            $response = $this->textToSpeechClient->synthesizeSpeech($inputText, $voice, $audioConfig);
            $audioContent = $response->getAudioContent();

            $fileName = 'speech/' . $this->word . '.mp3';
            Storage::disk('public')->put($fileName, $audioContent);

            return response()->json(['audio_url' => Storage::url($fileName)]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error processing the request', 'error' => $e->getMessage()], 500);
        }
    }


    public function uploadAudio(Request $request)
    {
        if (!$request->hasFile('audio')) {
            return response()->json(['message' => 'No file uploaded'], 400);
        }

        $file = $request->file('audio');

        Log::info($file);
        $filename = 'user_audio/' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
        try {
            Storage::disk('public')->put($filename, file_get_contents($file->getRealPath()));

            $userAudioPath = storage_path('app/public/' . $filename);
            $sampleAudioPath = $this->getSampleAudioPath($this->word);

            $analysisResult = $this->analyzeAudio($userAudioPath, $sampleAudioPath);
            return response()->json(['analysis' => $analysisResult]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error saving the file', 'error' => $e->getMessage()], 500);
        }
    }

    protected function getSampleAudioPath($word)
    {
        $filePath = 'speech/' . $word . '.mp3';
        return Storage::disk('public')->exists($filePath) ? storage_path('app/public/' . $filePath) : null;
    }

    protected function analyzeAudio($userAudioPath, $sampleAudioPath)
    {
        if (!File::exists($userAudioPath)) {
            return ['error' => 'User audio file not found'];
        }

        if ($sampleAudioPath && !File::exists($sampleAudioPath)) {
            return ['error' => 'Sample audio file not found'];
        }

        try {
            $userTranscription = $this->transcribeAudio($userAudioPath);
            $sampleTranscription = $sampleAudioPath ? $this->transcribeAudio($sampleAudioPath) : null;

            $isCorrect = $sampleTranscription ? $this->compareTranscription($userTranscription, $sampleTranscription) : null;

            return [
                'transcription' => $userTranscription,
                'is_correct' => $isCorrect
            ];
        } catch (Exception $e) {
            return ['error' => 'Error during analysis: ' . $e->getMessage()];
        }
    }

    protected function transcribeAudio($audioPath)
    {
        try {
            $audioContent = file_get_contents($audioPath);
            $audio = (new RecognitionAudio())->setContent($audioContent);

            $config = (new RecognitionConfig())
                ->setEncoding(AudioEncoding::LINEAR16)
                ->setSampleRateHertz(48000) // Set this to the sample rate of your audio file
                ->setLanguageCode('ja-JP');

            $response = $this->speechClient->recognize($config, $audio);
            $transcription = '';

            foreach ($response->getResults() as $result) {
                $transcription .= $result->getAlternatives()[0]->getTranscript();
            }

            return $transcription;
        } catch (Exception $e) {
            Log::error('Transcription error: ' . $e->getMessage());
            return null;
        }
    }


    protected function compareTranscription($userTranscription, $sampleTranscription)
    {
        if ($userTranscription === null || $sampleTranscription === null) {
            return false; // Or handle this case as you see fit.
        }
        return similar_text($userTranscription, $sampleTranscription) > 50;
    }
}
