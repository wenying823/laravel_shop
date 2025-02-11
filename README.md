
# Laravel Shop 專案  

## 專案簡介  
這是一個基於 Laravel 開發的簡易電商系統，提供了用戶認證、產品管理、購物車功能、訂單系統以及基礎的 RESTful API，適合作為學習或開發電商應用的基礎框架。  

---

## 功能列表  

1. **用戶功能**  
   - 設置用戶登入、登出功能（使用 Laravel Breeze）。  

2. **產品功能**  
   - 設置產品資料庫結構（MySQL）。  
   - 創建產品頁面，顯示產品資訊（名稱、價格、描述、圖片等）。  
   - 使用 Redis 快取技術快速加載產品資訊，提升系統效能。  

3. **購物車功能**  
   - 添加購物車功能，讓用戶可以將產品加入購物車並調整數量。  

4. **訂單功能**  
   - 設置訂單系統，讓用戶可以下訂單並完成結帳。  

5. **RESTful API**  
   - 提供以下 API 接口，讓第三方系統可以獲取產品資料：  
     - **GET `/api/products`**：獲取所有產品資訊。  
     - **GET `/api/products/{id}`**：根據產品 ID 獲取單一產品的詳細資訊。  

---

## 技術棧  

- **Laravel 10**：後端框架。  
- **MySQL**：資料庫，用於儲存用戶、產品和訂單數據。  
- **Redis**：用於快取產品資訊，提升查詢效能。  
- **Inertia.js**：前後端整合框架，用於頁面渲染和交互。  
- **Vue 3**：前端框架（如果適用）。  
- **Laravel Breeze**：用於快速搭建用戶認證功能。  

---

## 安裝與使用  

### 1. 環境需求  
- PHP >= 8.1  
- Composer  
- Node.js  
- MySQL  
- Redis  

### 2. 安裝步驟  

1. **克隆專案到本地**  
   ```bash
   git clone https://github.com/wenying823/laravel_shop.git
   cd laravel_shop
   ```

2. **安裝相依套件**  
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **配置環境變數**  
   複製 `.env.example` 文件並重命名為 `.env`，然後修改以下內容：  
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=你的資料庫名稱
   DB_USERNAME=你的資料庫用戶名
   DB_PASSWORD=你的資料庫密碼

   CACHE_DRIVER=redis
   ```

4. **生成應用密鑰**  
   ```bash
   php artisan key:generate
   ```

5. **執行資料庫遷移**  
   ```bash
   php artisan migrate
   ```

6. **啟動伺服器**  
   ```bash
   php artisan serve
   ```

   預設伺服器地址為：[http://127.0.0.1:8000](http://127.0.0.1:8000)。  

---

## 使用說明  

### API 測試  

以下是系統提供的 API 接口，返回的 JSON 結構包括 `success`、`data` 和 `message` 字段，用於描述操作結果和返回數據：  

1. **獲取所有產品資訊**  
   - **URL**: `GET /api/products`  
   - **範例回應**:  
     ```json
     {
       "success": true,
       "data": [
         {
           "id": 1,
           "name": "voluptas",
           "description": "Et autem quo quae provident rerum amet.",
           "price": "51.34",
           "stock": 48,
           "image": "https://picsum.photos/200/300",
           "created_at": "2024-12-20T07:04:14.000000Z",
           "updated_at": "2024-12-20T07:04:14.000000Z"
         },
         {
           "id": 2,
           "name": "veniam",
           "description": "Harum reiciendis quaerat saepe sint distinctio laborum quis ad corporis animi.",
           "price": "95.49",
           "stock": 12,
           "image": "https://picsum.photos/200/300",
           "created_at": "2024-12-20T07:04:14.000000Z",
           "updated_at": "2024-12-20T07:04:14.000000Z"
         }
       ],
       "message": "產品列表獲取成功"
     }
     ```

2. **獲取單一產品資訊**  
   - **URL**: `GET /api/products/{id}`  
   - **範例回應（成功）**:  
     ```json
     {
       "success": true,
       "data": {
         "id": 1,
         "name": "voluptas",
         "description": "Et autem quo quae provident rerum amet.",
         "price": "51.34",
         "stock": 48,
         "image": "https://picsum.photos/200/300",
         "created_at": "2024-12-20T07:04:14.000000Z",
         "updated_at": "2024-12-20T07:04:14.000000Z"
       },
       "message": "產品詳情獲取成功"
     }
     ```
   - **範例回應（失敗，產品不存在）**:  
     ```json
     {
       "success": false,
       "message": "產品未找到"
     }
     ```

---

## 項目結構  

- **`routes/web.php`**：網站主要功能路由。  
- **`routes/api.php`**：API 路由，用於提供外部接口。  
- **`app/Http/Controllers`**：控制器文件目錄，處理業務邏輯。  
- **`app/Models`**：模型文件目錄，對應資料庫結構。  

---

## 貢獻指南  

歡迎提交 Issue 或 Pull Request，參與貢獻本專案。  

---

## 授權  

本專案採用 [MIT License](https://opensource.org/licenses/MIT)。  
