# Dokumentasi Projek Website Nova Catering

- [TBD](#tbd)
- [General](#general)
   * [Administrasi Pengguna](#administrasi-pengguna)
      + [Registrasi Admin](#registrasi-admin)
      + [Penghapusan Admin](#penghapusan-admin)
- [REST API](#rest-api)
   * [Autentikasi](#autentikasi)
      + [Log In](#log-in)
      + [Log Out](#log-out)
   * [Partner](#partner)
      + [Mengambil partner tertentu](#mengambil-partner-tertentu)
      + [Mengambil semua partner](#mengambil-semua-partner)
      + [Mengambil semua partner dengan metadata](#mengambil-semua-partner-dengan-metadata)
      + [Mendaftarkan Partner Baru](#mendaftarkan-partner-baru)
      + [Mengubah Partner](#mengubah-partner)
      + [Menghapus Partner Tertentu](#menghapus-partner-tertentu)
   * [Review](#review)
      + [Mengambil semua review publik](#mengambil-semua-review-publik)
      + [Mengambil semua review, termasuk yang disembunyikan, dengan metadata](#mengambil-semua-review-termasuk-yang-disembunyikan-dengan-metadata)
      + [Mengambil review tertentu](#mengambil-review-tertentu)
      + [Menyembunyikan review](#menyembunyikan-review)
      + [Menampilkan review](#menampilkan-review)
      + [Membuat Review Baru](#membuat-review-baru)
      + [Menghapus review](#menghapus-review)
   * [Menu Satuan](#menu-satuan)
      + [Mengambil semua menu satuan](#mengambil-semua-menu-satuan)
      + [Mengambil semua menu satuan dengan metadata](#mengambil-semua-menu-satuan-dengan-metadata)
      + [Mengambil menu satuan tertentu](#mengambil-menu-satuan-tertentu)
      + [Membuat menu satuan baru](#membuat-menu-satuan-baru)
      + [Memperbaru menu satuan tertentu](#memperbaru-menu-satuan-tertentu)
      + [Menghapus menu satuan tertentu](#menghapus-menu-satuan-tertentu)
   * [Menu Paket](#menu-paket)
      + [Mengambil semua data menu paket](#mengambil-semua-data-menu-paket)
      + [Mengambil semua data menu paket dengan metadata](#mengambil-semua-data-menu-paket-dengan-metadata)
      + [Mengambil data menu paket tertentu](#mengambil-data-menu-paket-tertentu)
      + [Mengambil semua menu satuan untuk menu paket tertentu](#mengambil-semua-menu-satuan-untuk-menu-paket-tertentu)
      + [Membuat menu paket baru](#membuat-menu-paket-baru)
      + [Memperbaru menu paket tertentu](#memperbaru-menu-paket-tertentu)
      + [Menghapus menu paket tertentu](#menghapus-menu-paket-tertentu)

# TBD
- Captcha in review form

# General
## Administrasi Pengguna
Pendaftaran dan penghapusan akun admin tidak tersedia melalui antarmuka web. Kedua aksi tersebut dilakukan melalui perintah Artisan custom berikut.

### Registrasi Admin
```bash
php artisan admin:new <name> <password>
```
### Penghapusan Admin
```bash
php artisan admin:delete <name>
```

# REST API
Sebelum membaca lebih jauh, ada beberapa konvensi yang REST API ini patuhi.
Developer yang menggunakan REST API ini diharapkan mampu memahami konvensi tersebut
dan menggunakannya sesuai dengan konvensi yang telah ditetapkan.

REST API ini menggunakan JSON sebagai format pertukaran data, kecuali di beberapa
endpoint yang menerima file seperti di [`/api/partner/`](#partners) dan [`/api/paket/`](#paket)
untuk method POST dan PUT. Request untuk endpoint tersebut harus memiliki body dengan
MIME type multipart/form-data.

Karena API ini menggunakan Laravel, semua request PUT adalah request POST dengan field tambahan _method
yang memiliki nilai 'PUT.'

```json
{
    ...other data
    "_method" : "PUT"
}
```

Semua endpoint dengan HTTP method POST, PUT, dan DELETE adalah endpoint yang terlindungi.

Ada dua endpoint index, `/api/{resource}/` dan `/api/{resource}/index`.

`/api/{resource}/index` adalah endpoint yang dilindungi dan memerlukan [autentikasi](#autentikasi). Endpoint tersebut ditujukan untuk digunakan di dashboard. 

Sementara itu, `/api/{resource}/`  ditujukan untuk digunakan secara publik, dengan beberapa fitur data disembunyikan untuk menghemat waktu query.

## Autentikasi
Request yang mengakses endpoint yang terlindungi perlu menambahkan header Authentication dengan
nilai `{tipe_token} {token}`. Keduanya dapat diakses melalui [endpoint log in](#log-in).

### Log In
```bash
POST      /api/login
```
REST API ini menggunakan Bearer token untuk autentikasi. Token dapat diakses dengan melakukan request dengan username dan password admin yang telah didaftarkan sebelumnya melalui [command prompt](#administrasi-pengguna).

Contoh request:
```json
{
    "name" : "string",
    "password" : "string"
}
```

Contoh response:
```json
{
    "message": "Login success",
    "access_token": "TOKEN",
    "token_type": "Bearer"
}
```

### Log Out
```bash
POST      /api/logout
```
Endpoint ini terlindungi. Request ke endpoint ini tidak memerlukan body.
Endpoint ini membuat semua token dari user menjadi tidak valid.

## Partner
Secara umum, respons untuk method GET kelompok endpoint ini kurang lebih seperti berikut.
```json
{
    "nama" : "Partner",
    "logo" : "path/to/logo"
}
```

### Mengambil partner tertentu
```bash
GET       /api/partner/{id}
```
### Mengambil semua partner
```bash
GET       /api/partners
```
### Mengambil semua partner dengan metadata
```bash
GET       /api/partners/index
```
Endpoint ini terlindungi.

### Mendaftarkan Partner Baru
```bash
POST      /api/partner
```
```yaml
Fields:
    name: required, string
    logo: required, file, image
```
Endpoint ini terlindungi.

### Mengubah Partner
```bash
PUT       /api/partner/{id}
```
```yaml
Fields:
    name: optional, string
    logo: optional, file, image
```
Endpoint ini terlindungi.

### Menghapus Partner Tertentu
```bash
DELETE    /api/partner/{id}
```
Endpoint ini terlindungi. Request ke endpoint ini tidak memerlukan body.


## Review
Secara umum, respons untuk method GET kelompok endpoint ini kurang lebih seperti berikut.
```json
{
    "id" : 0,
    "reviewer_name" : "Fulan",
    "content" : "Lorem ipsum dolor sit amet..."
}
```
Untuk mengontrol visibilitas review, dapat menggunakan endpoint (`/api/review/{id}/show`)[#menyembunyikan-review] dan (`/api/review/{id}/show`)[#menampilkan-review]

### Mengambil semua review publik
```bash
GET       /api/reviews
```
### Mengambil semua review, termasuk yang disembunyikan, dengan metadata
```bash
GET       /api/reviews/index
```
Endpoint ini terlindungi.

### Mengambil review tertentu
```bash
GET       /api/review/{id}
```
### Menyembunyikan review
```bash
POST      /api/review/{id}/hide
```
Endpoint ini terlindungi. Request ke endpoint ini tidak memerlukan body.

### Menampilkan review
```bash
POST      /api/review/{id}/show
```
Endpoint ini terlindungi. Request ke endpoint ini tidak memerlukan body.

### Membuat Review Baru
```bash
POST      /api/review
```
```yaml
Fields:
    reviewer_name: required, string
    content: required, text
```
Endpoint ini terlindungi.

### Menghapus review
```bash
DELETE    /api/review/{id}
```
Endpoint ini terlindungi. Request ke endpoint ini tidak memerlukan body.


## Menu Satuan
### Mengambil semua menu satuan
```bash
GET       /api/satuans
```
### Mengambil semua menu satuan dengan metadata
```bash
GET       /api/satuans/index
```
Endpoint ini terlindungi.

### Mengambil menu satuan tertentu
```bash
GET       /api/satuan/{id}
```
### Membuat menu satuan baru
```bash
POST      /api/satuan
```
```yaml
Fields:
    nama: required, string
```
Endpoint ini terlindungi.

### Memperbaru menu satuan tertentu
```bash
PUT       /api/satuan/{id}
```
```yaml
Fields:
    nama: optional, string
```
Endpoint ini terlindungi.

### Menghapus menu satuan tertentu
```bash
DELETE    /api/satuan/{id}
```
Endpoint ini terlindungi. Request ke endpoint ini tidak memerlukan body.


## Menu Paket
### Mengambil semua data menu paket
```bash
GET       /api/pakets
```
### Mengambil semua data menu paket dengan metadata
```bash
GET       /api/pakets/index
```
Endpoint ini terlindungi.

### Mengambil data menu paket tertentu
```bash
GET       /api/paket/{id}
```
### Mengambil semua menu satuan untuk menu paket tertentu
```bash
GET       /api/paket/{id}/items
```
### Membuat menu paket baru
```bash
POST      /api/paket
```
```yaml
Fields:
    name: required, string
    harga: required, unsigned integer
    kategori: required, 'nasi_kotak' OR 'prasmanan'
    foto: required, file, image
    items: optional, array<satuan_id>
```
Endpoint ini terlindungi.

### Memperbaru menu paket tertentu
```PUT       bash
/api/paket/{id}
```
```yaml
Fields:
    name: optional, string
    harga: optional, unsigned integer
    kategori: optional, 'nasi_kotak' OR 'prasmanan'
    foto: optional, file, image
    items: optional, array<satuan_id>
```
Endpoint ini terlindungi.

### Menghapus menu paket tertentu
```bash
DELETE    /api/paket/{id}
```
Endpoint ini terlindungi. Request ke endpoint ini tidak memerlukan body.

