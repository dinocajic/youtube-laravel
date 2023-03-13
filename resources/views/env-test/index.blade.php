<h1>Environmental Variable Test</h1>

<ul>
    <li>Application Environment: {{ env('APP_ENV') }}</li>
    <li>Application URL: {{ env('APP_URL') }}</li>
    <li>Database Host: {{ env('DB_HOST') }}</li>
</ul>

<div>
    To report an issue, contact: {{ env('DEVELOPER_EMAIL') }}
</div>

@env('local')
    We're in the local environment
@endenv

@env('staging')
    We're in the staging environment
@endenv

@env('production')
    We're in the production environment
@endenv

@production
    We're in production
@endproduction
