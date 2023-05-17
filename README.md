# Laravel GraphQL Project

**This project is currently under development  and refactoring time by time.**

## Project Structure

### Modules

The project is divided into modules such as User, Auth, etc. Each module has its own directory under `App\Domains` and contains its own Actions, Models, Services, Events, etc. This modular approach helps in maintaining a clean architecture, especially when the application grows over time.

### Actions

Actions are the main business logic handlers. They represent a single action in the system, e.g., CreateUser, LoginUser, ActivateUser. The idea behind actions is to encapsulate specific functionality that could be reused across different parts of the application.

Each Action has a single `execute()` method that performs the necessary operations. These are injected into Services where required.

### Services

Services act as intermediaries between the Actions and the Controllers (or GraphQL mutations in this case). They handle the orchestration of different actions and additional procedures like firing events.

### GraphQL

The project uses GraphQL for the API layer, with mutations corresponding to different functionalities. Each mutation uses a Service to handle its functionality.

### Events

Events in Laravel provide a simple observer implementation, allowing you to subscribe and listen for events in your application. Event classes are stored in the `Events` directory.

## Testing

Unit and feature tests are crucial parts of this application. Each action, service, and mutation should be covered by tests to ensure the stability of the application.

## Authentication

Authentication is handled by Laravel Sanctum. It generates a plain-text token that's returned on login and checked on subsequent requests.
