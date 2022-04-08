# 学習用 Laravel 課題
Laravel の演習課題です。  
課題をこなすことによって、実際にアプリケーションを構築していきます。  
やや難しめです。

なお、1. 以外のすべてのステップで**テストコードを書く**ようにしてください。

## 作成するアプリ
ゆるふわ日報を管理する API を作成します。  
日報の 作成 / 取得 / 一覧 / 更新 / 削除 ができるAPIです。

## 課題
### 1. 環境構築
Laravel Sail を使用して [環境構築](https://readouble.com/laravel/9.x/ja/installation.html) を行ってください。

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/4b246d837197b633b47c38c033b043e5a2230854

### 2. 日報作成API
#### 2.1 エンドポイントの作成
日報を作成するエンドポイント(URL)を作成してください。
- POST メソッドでアクセスできるようにしてください。
- レスポンスコードは 204 NO CONTENT を返してください。
- 作成処理はまだ行なわくてかまいません。

ヒント:
- [ルーティング](https://readouble.com/laravel/9.x/ja/routing.html)
- [コントローラー](https://readouble.com/laravel/9.x/ja/controllers.html)
- [レスポンス](https://readouble.com/laravel/9.x/ja/responses.html)
- [テスト](https://readouble.com/laravel/9.x/ja/http-tests.html)

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/e178e4bafc5d98523f7d3d27a682094394c4ace8

#### 2.2 データの保存
日報作成エンドポイントで、日報を保存するようにしてください。
- 以下のカラムを持つテーブルを作成してください。
  - id
  - content
  - created_at
  - updated_at
- 日報のモデルを作成してください。
- コントローラ内で日報のインスタンスを作成・保存し、インスタンスを返すようにしてください。
  - `content` の内容は空文字でかまいません。
- レスポンスは JSON 形式で返してください。
- レスポンスコードは 201 CREATED を返してください。

ヒント:
- [マイグレーション](https://readouble.com/laravel/9.x/ja/migrations.html)
- [モデル](https://readouble.com/laravel/9.x/ja/eloquent.html)

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/cae10066cc68021e68f7a780305034ac53c4382a

#### 2.3 リクエストの受け付け
日報作成エンドポイントで日報のデータを受け取り、そのデータで日報を保存し、返却するようにしてください。
- リクエストは以下の内容がJSON形式で来ることを想定します。

  ```json
  {
    "content": "今日はこれをやりました。"
  }
  ```

- リクエストの内容で日報を保存するようにしてください。

ヒント:
- [リクエスト](https://readouble.com/laravel/9.x/ja/requests.html)

回答例:
- https://github.com/chiroruxx/aiit-quiz-laravel/commit/3871de6730a5831f87236686cf9c6c27c2291b23

#### 2.4 バリデーション
日報作成エンドポイントで入力に対してバリデーションを実施してください。
- `content` がリクエストに存在すること
- `content` が文字列であること
- `content` が191文字未満であること

ヒント:
- [バリデーション](https://readouble.com/laravel/9.x/ja/validation.html)

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/06c40b178c1d91430b914160a2d234e23af10cf4

### 3. 日報取得API
#### 3.1 エンドポイントの作成
日報を1件取得するエンドポイント(URL)を作成してください。
- GET メソッドでアクセスできるようにしてください。
- URLに日報のidを含めてください。
- レスポンスコードは 204 NO CONTENT を返してください。
- 存在しないIDの場合は 404 NOT FOUND を返してください。
- 取得処理はまだ行なわくてかまいません。

ヒント:
- [ファクトリー](https://readouble.com/laravel/9.x/ja/database-testing.html)

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/d9a87a0d95560515a455baa2f3e617cbcc29d059

#### 3.2 データの取得
日報取得エンドポイントで、URL内のIDに該当する日報を取得し、返却するようにしてください。
- レスポンスは JSON 形式で返してください。
- レスポンスコードは 200 OK を返してください。

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/8d83c511c0387afaa57cd25ecd3cd5fa465d729a

### 4. 日報一覧API
#### 4.1 エンドポイントの作成
日報を全件取得するエンドポイント(URL)を作成してください。
- GET メソッドでアクセスできるようにしてください。
- レスポンスコードは 204 NO CONTENT を返してください。
- 取得処理はまだ行なわくてかまいません。

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/5c2094ffdbc0eb9551fe1a237b6a03920e28e24d

#### 4.2 データの取得
日報一覧エンドポイントで、すべての日報を返却するようにしてください。
- レスポンスは JSON 形式で返してください。
- レスポンスコードは 200 OK を返してください。

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/5c0f19fd8ae557897fca686a2c5bd42e7d582df7

### 5. 日報更新API
#### 5.1 エンドポイントの作成
日報を更新するエンドポイント(URL)を作成してください。
- PATCH メソッドのみでアクセスできるようにしてください。
- URLに日報のidを含めてください。
- レスポンスコードは 204 NO CONTENT を返してください。
- 存在しないIDの場合は 404 NOT FOUND を返してください。
- 更新処理はまだ行なわくてかまいません。

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/0301396913ddd31c425ed57c7093ca4997ecca8f

#### 5.2 日報の更新
日報更新エンドポイントで日報のデータを受け取り、そのデータを返却するようにしてください。
- リクエストは以下の内容がJSON形式で来ることを想定します。

  ```json
  {
    "content": "今日はこれをやりませんでした。"
  }
  ```

- リクエストの内容で日報を更新するようにしてください。

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/e75538a42428d256f00447670b128d3b449b45ab

#### 5.3 バリデーション
日報更新エンドポイントで入力に対してバリデーションを実施してください。
- `content` がリクエストに存在すること
- `content` が文字列であること
- `content` が191文字未満であること

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/b1ecf6783c50a1340bd6c5f2f61eb4603c159354

### 6. 日報削除API
#### 6.1 エンドポイントの作成
日報を削除するエンドポイント(URL)を作成してください。
- DELETE メソッドでアクセスできるようにしてください。
- URLに日報のidを含めてください。
- レスポンスコードは 204 NO CONTENT を返してください。
- 存在しないIDの場合は 404 NOT FOUND を返してください。
- 削除処理はまだ行なわくてかまいません。

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/e1e10fd84f006b01b03518b5d7e044b96625d87b

#### 6.2 データの削除
日報削除エンドポイントで、日報を削除するようにしてください。

回答例: https://github.com/chiroruxx/aiit-quiz-laravel/commit/e2277865ba65c9605304e9743e2c08db1e59c84c
