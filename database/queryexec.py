
import os, argparse
import psycopg2
from dotenv import load_dotenv

DEFAULT_FILE_PATH='./DQL_DML_query.sql'

load_dotenv()

parser = argparse.ArgumentParser()
parser.add_argument('-f', '--file', required=False, help='Path to the input source file.')
parser.add_argument('-t', '--table', required=False, help='Name of table whoose content to print.')

args = parser.parse_args()

try:
    conn = psycopg2.connect(
        database=os.getenv('DB_NAME'),
        user=os.getenv('DB_USER'),
        password=os.getenv('DB_PASSWORD'),
        host=os.getenv('DB_HOST'),
        port=os.getenv('DB_PORT')
    )

    print("Database connected successfully!")

    cur = conn.cursor()

    if args.table is None:
        src_file = DEFAULT_FILE_PATH if args.file is None else args.file


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
except:
    print("Database not connected successfully!")
    exit(1)






