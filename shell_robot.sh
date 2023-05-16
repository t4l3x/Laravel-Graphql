mkdir -p Domains/Authentication/{Actions,Events,Listeners,Models,Policies,Types,Validators}
touch Domains/Authentication/Actions/{CreateUser,LoginUser}.php
touch Domains/Authentication/Events/UserRegistered.php
touch Domains/Authentication/Listeners/SendWelcomeEmail.php
touch Domains/Authentication/Models/User.php
touch Domains/Authentication/Policies/UserPolicy.php
touch Domains/Authentication/Types/{UserType,QueryType}.php
touch Domains/Authentication/Validators/{LoginValidator,RegisterValidator}.php

# GraphQL
mkdir -p GraphQL/{Mutations,Queries}
touch GraphQL/Mutations/{LoginMutation,RegisterMutation}.php
touch GraphQL/Queries/UserQuery.php
