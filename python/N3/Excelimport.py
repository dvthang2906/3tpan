import pandas as pd
from sqlalchemy import create_engine

# Thay thế các giá trị này bằng thông tin cơ sở dữ liệu MySQL của bạn
db_host = "localhost"
db_user = "3tpan"
db_password = "ecc"
db_name = "3tpandb"

# Tạo đối tượng Engine cho MySQL
engine = create_engine(
    f"mysql+mysqlconnector://{db_user}:{db_password}@{db_host}/{db_name}"
)

# Đọc dữ liệu từ tệp Excel vào DataFrame
df = pd.read_excel("N3-vocabulary.xlsx", sheet_name="Sheet1")

# Lưu DataFrame vào MySQL
df.to_sql(name="vocabulary", con=engine, if_exists="append", index=False)
