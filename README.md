# Email Campaign Analytics and Reporting System

This application is a simple **analytics and reporting system** for managing email campaigns. It includes user authentication, email campaign management, email sending and tracking, and a reporting dashboard to visualize campaign performance.

## Features

### 1. User Authentication
- **Registration** and **Login** functionalities are provided using Laravel’s built-in authentication features.
- Only authenticated users can access the dashboard, manage campaigns, and send emails.

### 2. Email Campaign Management
- **CRUD operations** (Create, Read, Update, Delete) for managing email campaigns and email templates.
- Templates allow users to save reusable HTML messages for email campaigns.
- Campaigns include a subject line, selected template, recipient list, and metadata.
- Users can select from saved templates while creating or updating a campaign.

### 3. Email Sending and Tracking
- **Email Sending**: Users can send emails to a specified list of recipients for each campaign.
- **Email Status Tracking**: Track the status of each email (sent, delivered, opened).
  - **Sent**: Default email status set as sent.
  - **Delivered**: Updated through a webhook notification from the email provider.
  - **Opened**: Updated through a webhook notification from the email provider.

### 4. Reporting Dashboard
- Displays metrics for email campaigns, including:
  - Total emails sent
  - Emails delivered
  - Emails opened
- **Charts** visualize these metrics using [Chart.js](https://www.chartjs.org/).
- Users can filter and select campaigns for a detailed view.

## Technologies Used

- **Backend**: Laravel 11 (API with Repository Design Pattern)
- **Frontend**: Vue 3, Pinia (state management), Tailwind CSS
- **Database**: MySQL for storing campaign and email status data
- **Charts**: Chart.js for data visualization on the dashboard

## Installation

### Prerequisites
- PHP >= 8.1
- Node.js >= 16
- Composer
- MySQL or any other supported database

### Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/shivragshukla/email-analytics-system.git
   cd email-analytics-system
   ```
2. **Install backend dependencies:**

   -  **Install PHP dependencies:**
  
    ```bash
   cd email-analytics-system/backend/ 
   composer install
   ```
   - **Set up environment variables:**
      - Copy `.env.example` to `.env`:
        ```bash
        cp .env.example .env
        ```
      - Update `.env` with your database credentials and email provider API details (e.g., SMTP, Mailgun, FRONTEND_URL, SANCTUM_STATEFUL_DOMAINS, SESSION_DOMAIN).
    
   -  **Run migrations:**
      ```bash
      php artisan migrate
      ```
      
   - **Generate application key:**
      ```bash
      php artisan key:generate
      ```
      
3. **Install frontend dependencies:**

   -  **Install JavaScript dependencies:**
      ```bash
      cd email-analytics-system/frontend/ 
      npm install
      ```

   - **Set up environment variables:**
      - Update `.env` with your backend api url (e.g., VITE_API_URL).
    

4. **Start the backend server:**
   ```bash
   cd email-analytics-system/backend/
   php artisan serve
   ```
5. **Build front-end assets:**
   ```bash
   cd email-analytics-system/frontend/
   npm run dev
   ```
6. **Run jobs to send Campaign mail**
   ```bash
   cd email-analytics-system/backend/
   php artisan queue:work
   ```

## Usage

### Accessing the Application
- Register and log in to access the dashboard.
- Navigate to the **Campaigns** section to manage email campaigns.
- Use the **Templates** section to create and save email templates.

### Sending Campaign Emails
- Go to the **Campaigns** section and select a campaign to send.
- Specify recipient emails and send the campaign.
- Track email statuses (sent, delivered, opened) on the Reporting Dashboard.

### Viewing the Reporting Dashboard
- Navigate to the **Dashboard** to see metrics for campaigns.
- Select a specific campaign to filter the data.
- View pie, bar, and line charts of campaign metrics.

## Code Structure

### Backend
- **Models**: Campaign, Template, EmailStatus
- **Controllers**: CampaignController, TemplateController, EmailStatusController
- **Repositories**: Repository classes for handling business logic
- **Database**: Migrations for creating necessary tables

### Frontend
- **Vue Components**: CRUD views for campaigns and templates, Reporting dashboard
- **State Management**: Pinia stores for managing state
- **Charts**: Chart.js for data visualization

## Email Tracking Implementation

- **Sent Status**: Default mail status set as sent.
- **Delivered/Opened Status**: Webhooks from the email provider (e.g., Mailgun) update the delivered/opened status.

## License

This project is open-source and available under the MIT License.

## Contact

For any questions or contributions, please reach out via email shivragshukla001@gmail.com or create a pull request.

## Screenshot

![image](https://github.com/user-attachments/assets/5885d3b9-d602-47b9-a8d3-79c3ebdea480)

![image](https://github.com/user-attachments/assets/ea75a4aa-498f-4eb5-83fb-2a460cb263c4)

![image](https://github.com/user-attachments/assets/29997f40-8eb4-4073-8c12-9fee8510bff9)

![image](https://github.com/user-attachments/assets/750dd7ee-e340-40a6-93bd-36e6e53f72d5)
