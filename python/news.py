import pandas as pd
from sqlalchemy import create_engine
from datetime import datetime

# Thay thế các giá trị này bằng thông tin cơ sở dữ liệu MySQL của bạn
db_host = "localhost"
db_user = "3tpan"
db_password = "ecc"
db_name = "3tpandb"

# Tên tệp Excel và tên sheet
excel_file = "news.xlsx"
sheet_name = "Sheet1"

# Đọc dữ liệu từ tệp Excel vào DataFrame
df = pd.read_excel(excel_file, sheet_name=sheet_name)

# Loại bỏ các hàng có giá trị null trong các cột cần thiết
df = df.dropna(subset=["title", "content", "images", "audio"])
# Thay thế giá trị null bằng một giá trị mặc định cho mỗi cột
df["title"].fillna("Tiêu đề mặc định", inplace=True)
df["content"].fillna("Nội dung mặc định", inplace=True)
df["images"].fillna("Đường dẫn hình ảnh mặc định", inplace=True)
df["audio"].fillna("Đường dẫn audio mặc định", inplace=True)

# Thêm cột thời gian nếu cần
current_time = datetime.now()
df["created_at"] = current_time
df["updated_at"] = current_time

# Tạo đối tượng Engine cho MySQL
engine = create_engine(
    f"mysql+mysqlconnector://{db_user}:{db_password}@{db_host}:3306/{db_name}"
)

# Lưu DataFrame vào MySQL, thêm vào bảng có sẵn mà không tạo mới
df.to_sql(name="news", con=engine, if_exists="append", index=False)
