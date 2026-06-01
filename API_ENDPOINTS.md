# API Documentation

Base URL: `http://localhost/api`

---

## 1. LOCATIONS API

### Get All Locations (Public)
```
GET /api/locations
```

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
