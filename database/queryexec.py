
import os, argparse
import psycopg2
from dotenv import load_dotenv

DEFAULT_DQL_DML_FILE_PATH='./DQL_DML_query.sql'
DEFAULT_DDL_FILE_PATH='./DDL_query.sql'

load_dotenv()

parser = argparse.ArgumentParser()
parser.add_argument('-f', '--file', required=False, help='Path to the input source file.')
parser.add_argument('-t', '--table', required=False, help='Name of table whoose content to print.')
parser.add_argument('-ddl', '--data_definition_language', action='store_true', required=False, help='Switches to execute DDL query file.')

args = parser.parse_args()

try:
    conn = psycopg2.connect(
        database=os.getenv('DB_DATABASE'),
        user=os.getenv('DB_ADMIN_USERNAME'),
        password=os.getenv('DB_ADMIN_PASSWORD'),
        host=os.getenv('DB_HOST'),
        port=os.getenv('DB_PORT')
    )

    print("Database connected successfully!")

    cur = conn.cursor()

    if args.table is None:
        src_file = DEFAULT_DDL_FILE_PATH if args.data_definition_language else DEFAULT_DQL_DML_FILE_PATH;
        print(src_file)

        with open(file=src_file, mode='r', encoding='utf-8') as file:
            query = file.read()
            cur.execute(query=query)

    else:
        query = f"""
            SELECT * from public.{args.table};
        """

        cur.execute(query=query)
        rows = cur.fetchall()

        print(f"{args.table}:")
        for row in rows:
            print(row)


    conn.commit()
    cur.close()
    conn.close()
except Exception as e:
    print(f"Database connection error: {str(e)}")
    print("Database not connected successfully!")
    exit(1)






