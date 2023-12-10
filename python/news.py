import pandas as pd
import mysql.connector
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

# Tạo đối tượng Engine cho MySQL
engine = create_engine(
    f"mysql+mysqlconnector://{db_user}:{db_password}@{db_host}:3306/{db_name}"
)

# Đọc dữ liệu từ tệp Excel vào DataFrame
df = pd.read_excel(excel_file, sheet_name=sheet_name)

# Thêm cột thời gian nếu cần
current_time = datetime.now()
df["created_at"] = current_time
df["updated_at"] = current_time

# Lưu DataFrame vào MySQL, thêm vào bảng có sẵn mà không tạo mới
df.to_sql(name="news", con=engine, if_exists="append", index=False)
