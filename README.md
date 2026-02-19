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

## Usage

The homepage presents the daily logic challenge. Users can browse additional puzzles using the search feature. Authenticated users can log in to access personalised features and interact with personal dashboards and to check orders.


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

This project is provided for educational and portfolio purposes.
