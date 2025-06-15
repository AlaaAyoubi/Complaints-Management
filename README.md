# Complaint Management System

This is a robust and user-friendly **Complaint Management System** built with **Laravel**, designed to streamline the process of submitting, tracking, and managing user complaints efficiently. The application provides a clear distinction between user and administrative functionalities, ensuring a secure and organized workflow for handling feedback and issues.

## 🚀 Features

* **User Dashboard:** Users can easily submit new complaints and view the status and details of their submitted complaints.
* **Admin Panel:** Administrators have a comprehensive overview of all complaints, with capabilities to:
    * View all submitted complaints.
    * Filter complaints by user and complaint type.
    * Update the status of complaints (e.g., Pending, In Progress, Resolved, Rejected).
* **Role-Based Access Control:** Secure authentication system with distinct roles for users and administrators, ensuring appropriate access to features.
* **Robust Validation:** Implemented server-side validation using Laravel Form Requests to ensure data integrity and provide clear error messages to users.
* **Configurable Settings:** Utilizes a custom configuration file (`config/complaints.php`) for easily managing application settings such as default complaint statuses and pagination limits, promoting flexibility and maintainability.
* **Performance Optimized:** Incorporates Eager Loading to address N+1 query problems, significantly enhancing database query efficiency and overall application performance, especially on data-heavy pages.
* **Intuitive User Interface:** Designed for ease of use for both submitting complaints and administrative management.

## 🛠️ Technologies Used

* **PHP:** Core programming language.
* **Laravel:** PHP Web Application Framework.
* **MySQL:** Relational Database Management System.
* **HTML, CSS (Tailwind CSS), JavaScript:** For front-end development and styling.
* **Composer:** PHP dependency manager.
* **NPM / Yarn:** JavaScript package managers (for frontend assets if applicable).

## 📦 Installation

Follow these steps to get the project up and running on your local machine:

1.  **Clone the Repository:**
    ```bash
    git clone [https://github.com/YOUR_USERNAME/YOUR_REPOSITORY_NAME.git](https://github.com/YOUR_USERNAME/YOUR_REPOSITORY_NAME.git)
    cd YOUR_REPOSITORY_NAME # Navigate into the project directory
    ```
    *(Replace `YOUR_USERNAME` and `YOUR_REPOSITORY_NAME` with your actual GitHub username and repository name.)*

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Install JavaScript Dependencies (if applicable, for Tailwind CSS, etc.):**
    ```bash
    npm install
    # or yarn install
    ```
    Then, compile assets:
    ```bash
    npm run dev
    # or yarn dev
    ```

4.  **Environment Configuration:**
    * Create a copy of the `.env.example` file and name it `.env`:
        ```bash
        cp .env.example .env
        ```
    * Generate an application key:
        ```bash
        php artisan key:generate
        ```
    * Open the `.env` file and configure your database connection (e.g., `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5.  **Database Migration and Seeding:**
    Run the migrations to create tables and seed the database with initial data (e.g., complaint types, default user/admin).
    ```bash
    php artisan migrate:fresh --seed
    ```
    *(This command will drop all existing tables and re-create them, then run seeders. Use with caution in production.)*

6.  **Start the Local Development Server:**
    ```bash
    php artisan serve
    ```
    The application will typically be accessible at `http://127.0.0.1:8000`.

## 🚀 Usage

### For Users:

1.  **Register:** Navigate to `/register` to create a new user account.
2.  **Login:** Access the login page at `/login` with your credentials.
3.  **Submit Complaint:** After logging in, go to the user dashboard to submit new complaints.
4.  **View Complaints:** See the status and details of your previously submitted complaints on your dashboard.

### For Administrators:

1.  **Login:** Access the login page at `/login`.
    * **Default Admin Credentials (if set in seeders):**
        * **Email:** `admin@example.com`
        * **Password:** `password` (or whatever you set in `UserSeeder.php`)
2.  **Manage Complaints:** From the admin dashboard, view, filter, and update the status of all user-submitted complaints.

## 🤝 Contributing

Contributions are welcome! If you find a bug or have a feature request, please open an issue or submit a pull request.

## 📄 License

This project is open-source and licensed under the [MIT License](https://opensource.org/licenses/MIT).

---