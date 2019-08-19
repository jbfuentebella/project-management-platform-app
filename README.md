# Project Management Platform App
The project contains API to store and fetch project and developer details

### What's in the App?
1. How Routes are made
    - The routes are done in the `routes/api.php` with proper httpd methods.
    - It is also wrapped in a middleware the forces every response to JSON.
    - The routes are partnered resouce methods (such as index, show, delete, store) in its appropiate controller. 

2. How Objects are used and How Models are utilized
    - Objects are used following the MVC pattern but in this exam there's no V to play with.
    - Controller relays the data to its appropriate model and determine responses depending on the status of the data and model transaction. It also uses data validation in a form of request validation or controller validation.
    - Model is the representation of the database and schema. It holds the definition of the object being processed like what are the fillables, hidden, guarded, relationships, and more.

3. Whether Migrations are used or not
    - The project contains migrations located in `database/migrations` and seeders in `database/seeds`
    - The tables contains fields specified in the exam with additonal personal fields:
        - `id`: to make the table in order and flexible for future db relationship schemas.
        - `lead_developer_id`: converted the name to id to make the developers table flexible for db relationships, and code adjustment
        - `timestamps`: in order to trace data creation
        - `slug`: in order to replace id as the main source to search data, additional small security for the app
        
4. Parameter Validation
    - Request Validation
        - we use `App\Http\Requests\ProjectRequest` request validation for request coming from a form.
    - Controller Validation
        - other method uses controller validation with simple parameters such as slugs

5. API responses (appropriate HTTP status code)
    - There are various HTTP status used:
        - `200`: Success Response
        - `422`: Unprocessable Entity
        - `404`: Page Not Found
    - API response are formatted:
        - we have `App\ResponseFormatter` to have default formatter for all response.
        - the pattern:
        ```
            {
                "success": true/false,
                "data": {
                    ...array of data/error
                },
                "message": message
            }
        ```

### Setup
> **NOTE:** Update in your own preference, below is just guide
1. **Clone from the repo**
- git clone https://github.com/jbfuentebella/project-management-platform-app.git `<FOLDER_NAME>`

2. **Database**
- Create a Database
    - CREATE DATABASE `<DATABASE_NAME>`
- Create User for the Database
    - CREATE USER `<DATABASE_USERNAME>`@'localhost' IDENTIFIED BY `<DATABASE_PASSWORD>`;
    - GRANT ALL PRIVILEGES ON `<DATABASE_NAME>`.* TO '`<DATABASE_USERNAME>`'@'localhost';
    - FLUSH PRIVILEGES;

3. **Update Environment (Windows)**
- Laravel .env
    - copy and paste the `.env.example` to `.env`
    - Update the following key:
        - `APP_ENV`: production
        - `APP_DEBUG`: false
        - `DB_DATABASE`: <DATABASE_NAME>
        - `DB_USERNAME`: <DATABASE_USERNAME>
        - `DB_PASSWORD`: <DATABASE_PASSWORD>
    - Install/Update laravel
        - `composer install`
    - Generate App Key
        - `php artisan key:generate`
- HOST
    - Update the file as Administrator: C:\Windows\System32\drivers\etc\hosts
    - Add `127.0.0.1 www.pmpa.com`
- Apache Vhosts (example)
    - Update your `httpd-vhost.conf`
    ``` 
    <VirtualHost *:80>
        ServerAdmin jbfuentebella25@gmail.com
        DocumentRoot "C:/xampp-new/htdocs/project-management-platform-app/public"
        ServerName pmpa.com
        ServerAlias www.pmpa.com
        ErrorLog "logs/pmpa-error.log"
        CustomLog "logs/pmpa-access.log" common
    </VirtualHost>
    ```
    - Then restart your apache.
4. **Seed**
    - Locate your project
    - Run the following command:
    ``` 
    php artisan db:seed 
    ```
### Test
> **NOTE:** Update in your own preference, below is just guide
- Open PostMan
- Available APIs:
    - http://www.pmpa.com/api/projects [GET]
        - RESPONSE:
        ```
        {
            "success": true,
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "name": "Keeley Boyer DVM",
                        "client_name": "Effie Mills",
                        "slug": "Y37YCeJ0",
                        "lead_developer_id": "AyXniB0p",
                        "created_at": "2019-08-19 15:56:50",
                        "updated_at": "2019-08-19 15:56:50"
                    },
                    {
                        "name": "Mr. Fabian Lubowitz Jr.",
                        "client_name": "Marilie Satterfield",
                        "slug": "w87lEwNU",
                        "lead_developer_id": "AyXniB23",
                        "created_at": "2019-08-19 15:56:50",
                        "updated_at": "2019-08-19 15:56:50"
                    },
                    ...more
                ],
                "first_page_url": "http://www.pmpa.com/api/projects?page=1",
                "from": 1,
                "last_page": 10,
                "last_page_url": "http://www.pmpa.com/api/projects?page=10",
                "next_page_url": "http://www.pmpa.com/api/projects?page=2",
                "path": "http://www.pmpa.com/api/projects",
                "per_page": 15,
                "prev_page_url": null,
                "to": 15,
                "total": 150
            },
            "message": "Projects!"
        }
        ```
    - http://www.pmpa.com/api/project/{slug} [GET]
        - RESPONSE:
        ```
        {
            "success": true,
            "data": {
                "name": "Keeley Boyer DVM",
                "client_name": "Effie Mills",
                "slug": "Y37YCeJ0",
                "lead_developer_id": "AyXniBe0",
                "created_at": "2019-08-19 15:56:50",
                "updated_at": "2019-08-19 15:56:50"
            },
            "message": "Project Found!"
        }
        ```
    - http://www.pmpa.com/api/project [POST]
        - BODY (form-data):
            - `name`: Elite Digital PHP Exam
            - `client_name`: Elite Digital
            - `lead_developer_id`: "AyXnidgs"
        - RESPONSE: 
        ```
            {
                "success": true,
                "data": {
                    "name": "Elite Digital PHP Exam",
                    "client_name": "Elite Digital",
                    "lead_developer_id": "AyXnidgs",
                    "slug": "LGGK7v2i",
                    "updated_at": "2019-08-19 19:09:23",
                    "created_at": "2019-08-19 19:09:23"
                },
                "message": "New Project saved successfully!"
            }
        ```
    - http://www.pmpa.com/api/project/{slug} [DELETE]
        - RESPONSE:
        ```
        {
            "success": true,
            "data": [],
            "message": "Project Deleted!"
        }
        ```
    - http://www.pmpa.com/api/developers [GET]
        - RESPONSE:
        ```
        {
            "success": true,
            "data": {
                "current_page": 1,
                "data": [
                    {
                        "name": "Dr. Brooklyn Murazik Jr.",
                        "type": "backend",
                        "slug": "D7PX47V7",
                        "created_at": "2019-08-19 15:56:42",
                        "updated_at": "2019-08-19 15:56:42"
                    },
                    {
                        "name": "Bart Herman",
                        "type": "frontend",
                        "slug": "OXExzmOE",
                        "created_at": "2019-08-19 15:56:42",
                        "updated_at": "2019-08-19 15:56:42"
                    },
                    ...more
                ],
                "first_page_url": "http://www.pmpa.com/api/developers?page=1",
                "from": 1,
                "last_page": 10,
                "last_page_url": "http://www.pmpa.com/api/developers?page=10",
                "next_page_url": "http://www.pmpa.com/api/developers?page=2",
                "path": "http://www.pmpa.com/api/developers",
                "per_page": 15,
                "prev_page_url": null,
                "to": 15,
                "total": 150
            },
            "message": "Developers!"
        }
        ```