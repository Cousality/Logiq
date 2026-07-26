# LOGIQ

LOGIQ is a web-based logic puzzle platform that delivers daily brain teasers and pattern-recognition challenges in a clean, minimal interface. The application is built to demonstrate full-stack web development using Laravel, with a focus on structured MVC architecture, database integration, and responsive UI design.

The project was developed as a team-based software engineering exercise, with emphasis on maintainable code and a polished user experience.


## Features

* Daily logic puzzle challenges
* Pattern and sequence-based problem sets
* Searchable puzzle catalogue
* User authentication (login and registration)
* Theme toggle
* Custom 404 error page
* Responsive layout for desktop and mobile
* Laravel MVC architecture


## Tech Stack

**Backend**

* PHP 8.x
* Laravel 9.52.21

**Frontend**

* Blade templating engine
* JavaScript
* CSS

**Database**

* MySQL

**Tooling**

* Composer
* Node.js & NPM
* Apache (XAMPP for local development)

## Project Structure

```
.
├── app/            Application logic and controllers  
├── resources/     Blade views, frontend assets  
├── routes/        Web routing  
├── public/        Publicly accessible assets  
├── database/      Migrations and seeders  
├── storage/       Logs and cache  
└── tests/         Automated tests  
```


### Prerequisites

* PHP 8.x
* Composer
* Node.js (LTS)
* MySQL
* Apache (or XAMPP)

## Setup Instructions 

1. Download composer 
2. Download Xampp
3. Start Apache and MySQL 
4. In my SQL Copy and paste the .SQL table and contents 
5. Clone repository 
6. In the terminal Write Composer Install 
7. In the terminal Write php artisan serve

## Project Images 
<img width="1918" height="991" alt="image" src="https://github.com/user-attachments/assets/d40c0f49-d25e-40c8-b7fb-62bfa58e2aa2" />
<img width="1918" height="1000" alt="image" src="https://github.com/user-attachments/assets/c1527e66-d08a-4f09-a2fd-a9b6c69cf28c" />

<img width="1858" height="952" alt="image" src="https://github.com/user-attachments/assets/8e94d930-300c-45dc-9c33-0749e9f0afcb" />
<img width="1918" height="1000" alt="image" src="https://github.com/user-attachments/assets/6d75ae82-3456-4bda-b469-7bc13b8e07e5" />


## Usage

The homepage presents the daily logic challenge. Users can browse additional puzzles using the search feature. Authenticated users can login to access personalised features and interact with personal dashboards and to check orders.


## Design Goals

* Clean and readable MVC architecture
* Maintainable codebase
* Simple, distraction-free UI
* Scalable foundation for adding new puzzle types and user features


## Future Enhancements

* Difficulty tiers and puzzle categorisation
* User progress tracking
* Leaderboards and achievements
* REST API for mobile clients

## Contributors

Developed collaboratively as part of a group software engineering project. Full team list available on GitHub.

## Licence

This project is for educational and portfolio purposes.
