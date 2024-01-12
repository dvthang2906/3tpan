import pandas as pd
import mysql.connector
from sqlalchemy import create_engine
import sys
import traceback

# Nhận đường dẫn file và tên sheet từ tham số
excel_file = sys.argv[1]
sheet_name = sys.argv[2]

print(excel_file)
print(sheet_name)

# Thay thế các giá trị này bằng thông tin cơ sở dữ liệu MySQL của bạn
db_host = "localhost"
db_user = "3tpan"
db_password = "ecc"
db_name = "3tpandb"

# Kiểm tra kết nối MySQL
try:
    db_connection = mysql.connector.connect(
        host=db_host, user=db_user, password=db_password, database=db_name
    )
    if db_connection.is_connected():
        print("Kết nối thành công tới MySQL".encode("utf-8").decode("cp932", "ignore"))
        # Tạo đối tượng Engine cho MySQL
        print("12")
        engine = create_engine(
            f"mysql+mysqlconnector://{db_user}:{db_password}@{db_host}:3306/{db_name}"
        )
        print("1234")
        # Đọc dữ liệu từ tệp Excel vào DataFrame
        try:
            print("12345")
            df = pd.read_excel(excel_file, sheet_name=sheet_name)
            print("123456")
            print(df.head())
            print("1234567")
        except Exception as e:
            print(f"Lỗi khi đọc tệp Excel: {e}")
            traceback.print_exc()
except Error as e:
    print(f"Lỗi khi kết nối tới MySQL: {e}")
    exit(1)  # Dừng chương trình nếu không thể kết nối


# Xóa
# # Lưu DataFrame vào MySQL
# try:
#     df.to_sql(name="test_mondai", con=engine, if_exists="append", index=False)
#     print("Dữ liệu đã được lưu vào MySQL")
# except Exception as e:
#     print(f"Lỗi khi lưu dữ liệu vào MySQL: {e}")

# # Đóng kết nối MySQL
# if db_connection.is_connected():
#     db_connection.close()
#     print("Kết nối MySQL đã được đóng.")
