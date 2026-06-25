import mysql.connector
import requests
import json
from datetime import datetime

from urllib.parse import urlparse

def clean_domain(url):
    if not url:
        return ""

    url = url.strip()

    # Garante que urlparse consiga identificar o domínio
    if not url.startswith(("http://", "https://")):
        url = "http://" + url

    parsed = urlparse(url)

    domain = parsed.netloc.lower()

    # Remove www.
    if domain.startswith("www."):
        domain = domain[4:]

    return domain

# ==========================
# CONFIG MYSQL
# ==========================
MYSQL_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "tungstenio_collection"
}

# ==========================
# CONFIG API
# ==========================
API_URL = "http://localhost/wpvalidation/action/api_add_adepto"

def get_wordpress_collections():
    conn = mysql.connector.connect(**MYSQL_CONFIG)
    cursor = conn.cursor(dictionary=True)

    query = """
        SELECT
            ucode,
            name,
            sales_page,
            email,
            plataform,
            price,
            commission,
            affiliation_type,
            real_sales_page
        FROM collections
        WHERE is_wordpress = 1 AND is_wordpress_processed=1
    """

    cursor.execute(query)
    rows = cursor.fetchall()

    cursor.close()
    conn.close()

    return rows


def send_to_api(record):
    payload = {
        "ucode": record.get("ucode"),
        "name": record.get("name"),
        "sales_page": record.get("sales_page"),
        "email": record.get("email"),
        "plataform": record.get("plataform"),
        "price": record.get("price"),
        "commission": record.get("commission"),
        "affiliation_type": record.get("affiliation_type"),
        "real_sales_page": clean_domain(record.get("real_sales_page"))
    }

    # print(record.get("real_sales_page"))
    # print(clean_domain(record.get("real_sales_page")))
    # print('\n')

    try:
        response = requests.post(
            API_URL,
            data=payload,
            timeout=30
        )

        print(
            f"[{response.status_code}] "
            # f"{record.get('ucode')} - {record.get('name')}"
        )

        try:
            print(response.json())
        except:
            print(response.text)

    except Exception as e:
        print(
            f"Erro ao enviar {record.get('ucode')}: {str(e)}"
        )


def main():
    registros = get_wordpress_collections()

    print(f"Encontrados {len(registros)} registros")

    for registro in registros:
        send_to_api(registro)

    print("Processo finalizado")


if __name__ == "__main__":
    main()