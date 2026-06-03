# API Documentation

Base URL: `http://localhost/api`

---

## 1. LOCATIONS API

### Get All Locations (Public)
```
GET /api/locations
```

**Catatan:** endpoint `GET /api/locations` dan `GET /api/locations/{id}` bisa dipanggil tanpa token. Alias singular `GET /api/location` dan `GET /api/location/{id}` juga tersedia.

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Store Location 1",
            "phone": "081234567890",
            "address": "Jl. Merdeka No. 123",
            "open_shop": "08:00 - 22:00",
            "kota": "Jakarta",
            "daerah": "Jakarta Pusat",
            "google_maps_url": "https://maps.google.com/...",
            "description": "Our main store",
            "created_at": "2026-06-01T10:00:00Z",
            "updated_at": "2026-06-01T10:00:00Z"
        }
    ],
    "message": "Locations retrieved successfully"
}
```

### Get Single Location (Public)
```
GET /api/locations/{id}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Store Location 1",
        "phone": "081234567890",
        "address": "Jl. Merdeka No. 123",
        "open_shop": "08:00 - 22:00",
        "kota": "Jakarta",
        "daerah": "Jakarta Pusat",
        "google_maps_url": "https://maps.google.com/...",
        "description": "Our main store",
        "created_at": "2026-06-01T10:00:00Z",
        "updated_at": "2026-06-01T10:00:00Z"
    },
    "message": "Location retrieved successfully"
}
```

### Create Location (Admin Only)
```
POST /api/locations
Authorization: Bearer {token}
Content-Type: application/json
```

**Request Body:**
```json
{
    "name": "New Store",
    "phone": "081234567890",
    "address": "Jl. Sudirman No. 456",
    "open_shop": "09:00 - 21:00",
    "kota": "Jakarta",
    "daerah": "Jakarta Selatan",
    "google_maps_url": "https://maps.google.com/...",
    "description": "New branch location"
}
```

### Update Location (Admin Only)
```
PUT /api/locations/{id}
Authorization: Bearer {token}
Content-Type: application/json
```

### Delete Location (Admin Only)
```
DELETE /api/locations/{id}
Authorization: Bearer {token}
```

---

## 2. PRODUCTS API

### Get All Products (Public)
```
GET /api/products?per_page=15&status=1&search=keyword
```

**Catatan:** endpoint `GET /api/products` dan `GET /api/products/{id}` bisa dipanggil tanpa token. Alias singular `GET /api/product` dan `GET /api/product/{id}` juga tersedia.

**Query Parameters:**
- `per_page` - Items per page (default: 15)
- `status` - Filter by status (1=active, 0=inactive)
- `search` - Search by name or description

**Response:**
```json
{
    "success": true,
    "data": {
        "data": [
            {
                "id": 1,
                "name": "Product Name",
                "description": "Product description",
                "price": 99999,
                "image": "products/image.jpg",
                "status": 1,
                "category": {
                    "id": 1,
                    "name": "Category Name",
                    "slug": "category-name"
                },
                "subCategory": {
                    "id": 2,
                    "category_id": 1,
                    "name": "Sub Category Name",
                    "slug": "sub-category-name",
                    "description": "Sub category description"
                },
                "created_at": "2026-06-01T10:00:00Z",
                "updated_at": "2026-06-01T10:00:00Z"
            }
        ],
        "current_page": 1,
        "per_page": 15,
        "total": 50,
        "last_page": 4,
        "next_page_url": "http://localhost/api/products?page=2"
    },
    "message": "Products retrieved successfully"
}
```

### Get Single Product (Public)
```
GET /api/products/{id}
```

**Response:** sama seperti list product, tetapi `data` berisi satu object product dengan relasi `category` dan `subCategory`.

### Create Product (Admin Only)
```
POST /api/products
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Form Data:**
```
name: "Product Name"
description: "Product description"
price: 99999
image: [file]
status: 1
```

### Update Product (Admin Only)
```
PUT /api/products/{id}
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

### Delete Product (Admin Only)
```
DELETE /api/products/{id}
Authorization: Bearer {token}
```

---

## 3. CONTENT PAGES API

### Get All Content Pages (Public)
```
GET /api/content-pages?per_page=15&status=1&search=keyword&slug=page-slug
```

**Query Parameters:**
- `per_page` - Items per page (default: 15)
- `status` - Filter by status (1=active, 0=inactive)
- `search` - Search by title, slug, or content
- `slug` - Get page by slug (returns single object)

**Response:**
```json
{
    "success": true,
    "data": {
        "data": [
            {
                "id": 1,
                "page_name": "About Us",
                "title": "About Our Company",
                "slug": "about-us",
                "subtitle": "Learn more about us",
                "description": "Short description",
                "content": "<p>Full content here</p>",
                "featured_image": "content-pages/image.jpg",
                "status": 1,
                "created_at": "2026-06-01T10:00:00Z",
                "updated_at": "2026-06-01T10:00:00Z"
            }
        ],
        "current_page": 1,
        "per_page": 15,
        "total": 10,
        "last_page": 1
    },
    "message": "Content pages retrieved successfully"
}
```

### Get Content Page by Slug (Public)
```
GET /api/content-pages?slug=about-us
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "page_name": "About Us",
        "title": "About Our Company",
        "slug": "about-us",
        "subtitle": "Learn more about us",
        "description": "Short description",
        "content": "<p>Full content here</p>",
        "featured_image": "content-pages/image.jpg",
        "status": 1,
        "created_at": "2026-06-01T10:00:00Z",
        "updated_at": "2026-06-01T10:00:00Z"
    },
    "message": "Content page retrieved successfully"
}
```

### Get Single Content Page (Public)
```
GET /api/content-pages/{id}
```

### Create Content Page (Admin Only)
```
POST /api/content-pages
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Form Data:**
```
page_name: "Page Name"
title: "Page Title"
slug: "page-slug"
subtitle: "Page subtitle"
description: "Short description"
content: "<p>Full HTML content</p>"
featured_image: [file]
status: 1
```

### Update Content Page (Admin Only)
```
PUT /api/content-pages/{id}
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

### Delete Content Page (Admin Only)
```
DELETE /api/content-pages/{id}
Authorization: Bearer {token}
```

---

## 4. BLOGS API

Blog endpoints are available through the API for public listing and admin management.

### Get All Blogs (Public)
```
GET /api/blogs
```

**Catatan:** endpoint `GET /api/blogs` dan `GET /api/blogs/{id}` bisa dipanggil tanpa token.

**Response:**
```json
{
    "data": {
        "data": [
            {
                "id": 1,
                "title": "Blog Title",
                "slug": "blog-title",
                "content": "<p>Blog content</p>",
                "featured_image": "blogs/image.jpg",
                "author_id": 1,
                "category_id": 1,
                "tags": "news,promo",
                "published_at": "2026-06-02T10:00:00Z",
                "status": 1
            }
        ]
    }
}
```

### Get Single Blog (Public)
```
GET /api/blogs/{id}
```

### Create Blog (Admin Only)
```
POST /api/blogs
Authorization: Bearer {token}
Content-Type: application/json
```

**Form Data:**
```json
{
    "title": "Blog Title",
    "slug": "blog-title",
    "content": "<p>Blog content</p>",
    "featured_image": "blogs/image.jpg",
    "author_id": 1,
    "category_id": 1,
    "tags": "news,promo",
    "published_at": "2026-06-02 10:00:00",
    "status": 1
}
```

**Notes:**
- `featured_image` is stored as a string path in the API.
- The web admin blog form generates the slug automatically.

### Update Blog (Admin Only)
```
PUT /api/blogs/{id}
Authorization: Bearer {token}
Content-Type: application/json
```

### Delete Blog (Admin Only)
```
DELETE /api/blogs/{id}
Authorization: Bearer {token}
```

---

## 5. PROMOTIONS API

Promotions are available through the API for public listing and admin management.

### Get All Promotions (Public)
```
GET /api/promotions?per_page=10&active=1&search=summer
```

**Catatan:** endpoint `GET /api/promotions` dan `GET /api/promotions/{id}` bisa dipanggil tanpa token.

**Query Parameters:**
- `per_page` - Items per page (default: 10)
- `active` - Filter by active state (`1` or `0`)
- `search` - Search by promotion name

**Response:**
```json
{
    "success": true,
    "data": {
        "data": [
            {
                "id": 1,
                "name": "Summer Promo",
                "active": true,
                "datetime": "2026-06-02T12:30:00Z",
                "images": [
                    "promotions/image-1.jpg",
                    "promotions/image-2.jpg"
                ],
                "created_at": "2026-06-02T10:00:00Z",
                "updated_at": "2026-06-02T10:00:00Z"
            }
        ],
        "current_page": 1,
        "per_page": 10,
        "total": 5,
        "last_page": 1
    },
    "message": "Promotions retrieved successfully"
}
```

### Get Single Promotion (Public)
```
GET /api/promotions/{id}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Summer Promo",
        "active": true,
        "datetime": "2026-06-02T12:30:00Z",
        "images": [
            "promotions/image-1.jpg",
            "promotions/image-2.jpg"
        ],
        "created_at": "2026-06-02T10:00:00Z",
        "updated_at": "2026-06-02T10:00:00Z"
    },
    "message": "Promotion retrieved successfully"
}
```

### Create Promotion (Admin Only)
```
POST /api/promotions
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

**Form Data:**
```
name: "Summer Promo"
active: 1
datetime: "2026-06-02 12:30"
images[]: [file]
images[]: [file]
```

**Notes:**
- `images` is stored as a JSON array.
- Each promotion image supports uploads up to `20480 KB`.

### Update Promotion (Admin Only)
```
PUT /api/promotions/{id}
Authorization: Bearer {token}
Content-Type: multipart/form-data
```

### Delete Promotion (Admin Only)
```
DELETE /api/promotions/{id}
Authorization: Bearer {token}
```

---

## Frontend Usage Examples

### JavaScript/Fetch

**Get all locations:**
```javascript
fetch('http://localhost/api/locations')
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));
```

**Get location by slug:**
```javascript
fetch('http://localhost/api/content-pages?slug=about-us')
    .then(res => res.json())
    .then(data => console.log(data.data))
    .catch(err => console.error(err));
```

**Get products with filtering:**
```javascript
fetch('http://localhost/api/products?status=1&per_page=10')
    .then(res => res.json())
    .then(data => console.log(data.data))
    .catch(err => console.error(err));
```

### Vue 3 / Axios

```javascript
import axios from 'axios';

const API_BASE = 'http://localhost/api';

// Get all locations
axios.get(`${API_BASE}/locations`)
    .then(res => {
        console.log(res.data.data);
    });

// Get location by ID
axios.get(`${API_BASE}/locations/1`)
    .then(res => {
        console.log(res.data.data);
    });

// Get products
axios.get(`${API_BASE}/products`, {
    params: {
        status: 1,
        per_page: 10,
        search: 'laptop'
    }
})
    .then(res => {
        console.log(res.data.data);
    });

// Get content page by slug
axios.get(`${API_BASE}/content-pages`, {
    params: { slug: 'about-us' }
})
    .then(res => {
        console.log(res.data.data);
    });
```

### React

```javascript
import { useEffect, useState } from 'react';

function ProductList() {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        fetch('http://localhost/api/products?status=1')
            .then(res => res.json())
            .then(data => setProducts(data.data.data));
    }, []);

    return (
        <div>
            {products.map(product => (
                <div key={product.id}>
                    <h3>{product.name}</h3>
                    <p>Rp {product.price.toLocaleString()}</p>
                </div>
            ))}
        </div>
    );
}
```

---

## CORS Configuration

Jika frontend berada di domain berbeda, pastikan CORS sudah dikonfigurasi di `config/cors.php`:

```php
'paths' => ['api/*'],
'allowed_methods' => ['*'],
'allowed_origins' => ['*'],
```

---

## Authentication

Untuk admin endpoints (create, update, delete), gunakan token dari login:

```javascript
const token = 'your_sanctum_token_here';

axios.post(`${API_BASE}/products`, 
    { name: 'Product', price: 99999 },
    { headers: { Authorization: `Bearer ${token}` } }
);
```

**Catatan untuk frontend browser:**
- Jika frontend memakai bearer token, simpan token dari `POST /api/login` lalu kirim di header `Authorization: Bearer <token>`.
- Jika frontend memakai session/cookie auth, panggil `GET /sanctum/csrf-cookie` dulu, lalu kirim request dengan credentials aktif.

---

## Error Handling

Setiap response error akan mengembalikan:

```json
{
    "success": false,
    "message": "Error message",
    "error": "Detailed error"
}
```

**HTTP Status Codes:**
- `200` - Success
- `201` - Created
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error
