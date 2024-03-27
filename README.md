# PHP-Link-Shortener
 For this project i was using Laravel Framework 11.1.0
    
    //Installation
To install this project, follow these steps:

Clone the repository: git clone <repo-url>
Install dependencies: composer install
Copy the .env.example file to .env and configure your environment variables
Generate an application key: php artisan key:generate
Run the database migrations: php artisan migrate
Start the development server: php artisan serve

    //Usage
Open your browser and navigate to http://localhost:8000
Enter a valid URL link in the input field provided.
Click on the "Shorten URL" button.
The newly added link will be displayed in the table below.
Every click on a shortened link is counted, and the click count is displayed in the hits column