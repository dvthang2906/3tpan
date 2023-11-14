import speech_recognition as sr
import numpy as np
from flask import Flask, request, jsonify

# Hàm ghi âm giọng nói người dùng
def record_user_voice():
    r = sr.Recognizer()
    with sr.Microphone() as source:
        print("Recording...")
        audio = r.listen(source)

    user_voice = r.recognize_google(audio)
    return user_voice
# Hàm lấy dữ liệu giọng nói mẫu của người bản ngữ
def get_native_voice():
    native_voice = open("native_voice.wav").read()
    return native_voice

# Hàm so sánh ngữ điệu
def compare_intonation(user_voice, native_voice):
    user_features = extract_features(user_voice)
    native_features = extract_features(native_voice)

    score = np.corrcoef(user_features, native_features)[0, 1]
    return score

# Hàm trả về kết quả phân tích
def give_feedback(user_voice, native_voice):
    score = compare_intonation(user_voice, native_voice)

    if score >= 0.8:
        print("Great job! Your intonation is very close to native's.")
    elif score >= 0.5:
        print("Good job. Try improving the smoothness of your voice.")
    else:
        print("Let's practice some more. Pay attention to prolonging vowels.")

user_voice = record_user_voice()
native_voice = get_native_voice()
give_feedback(user_voice, native_voice)
