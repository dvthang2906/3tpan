import pandas as pd
import mysql.connector
from sqlalchemy import create_engine

# Thay thế các giá trị này bằng thông tin cơ sở dữ liệu MySQL của bạn
db_host = "localhost"
db_user = "3tpan"
db_password = "ecc"
db_name = "3tpandb"

# Tên tệp Excel và tên sheet
excel_file = "N4_test.xlsx"
sheet_name = "s1"

# Tạo kết nối MySQL
db_connection = mysql.connector.connect(
    host=db_host, user=db_user, password=db_password, database=db_name
)

# Tạo đối tượng Engine cho MySQL
engine = create_engine(
    f"mysql+mysqlconnector://{db_user}:{db_password}@{db_host}:3306/{db_name}"
)

# Đọc dữ liệu từ tệp Excel vào DataFrame
df = pd.read_excel(excel_file, sheet_name=sheet_name)

# # Loại bỏ các hàng có giá trị NA trong cột 'stt'
# df = df.dropna(subset=["stt"])

# # Ép kiểu cho cột 'stt' thành int
# if "stt" in df.columns:
#     df["stt"] = df["stt"].astype(int)


# Lưu DataFrame vào MySQL
df.to_sql(name="test_mondai", con=engine, if_exists="replace", index=False)
# In ra 5 hàng đầu tiên của DataFrame
# print(df.head())

# df = df.drop(columns=["Unnamed: 0"])


##########

# import pandas as pd

# df = pd.read_excel(r"C:\N5-vocabulary", sheet_name="Sheet1")
# array1 = df.values.tolist()
# for l in array1:
#     (
#         name1,
#         brand_id1,
#         campainge1,
#         sreport1,
#         rreport1,
#         buysreport1,
#         buyrreport1,
#         product_id1,
#         brand_011,
#         product_011,
#     ) = l
#     name = name1
#     brand_id = brand_id1
#     campainge = campainge1
#     product_id = product_id1
#     brand_01 = brand_011
#     product_01 = product_011
#     print(name1, campainge1, product_id1, brand_id1, product_011, brand_011)


# Đóng kết nối MySQL
db_connection.close()
