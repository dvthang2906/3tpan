import pandas as pd
from sqlalchemy import create_engine

# Đường dẫn kết nối đến MySQL database
# Thay '3tpan', 'ecc', '3tpandb' bằng thông tin tương ứng của bạn
db_connection_str = 'mysql+mysqlconnector://3tpan:ecc@localhost/3tpandb'

# Tạo đối tượng engine
engine = create_engine(db_connection_str)

# Đọc dữ liệu từ MySQL vào DataFrame
df = pd.read_sql('DESC vocabulary', con=engine)

# Ghi DataFrame vào Excel
df.to_excel('vocabulary.xlsx', index=False)
