# API Docs Kibernum Technical Test 

<larecipe-card shadow>
    Welcome to the API Documentation
</larecipe-card>

This Api Rest uses [Venoudev Results](https://github.com/venoudev/results) for json structure response and app architecture with Services, Actions and Validators.

|Json Response Structure|
|:-|

```json
{
    "success": bool ,
    "description": "string",
    "data": { JsonObject{} || JsonArrayObject[] },
    "errors": [
        {
            "error_code": "[CODE]",
            "field": "[FIELD || NOTHING]",
            "message": "string"
        }
    ],
    "messages": [
        {
            "message_code": "[CODE]",
            "message": "string"
        }
    ]
}
```

> {info} Message Object

#### Example
```json
    {
        "message_code": "LOGIN_SUCCESS",
        "message": "Login do correctly"
    }

```

> {danger} Error Object

#### Example
```json

    {
        "error_code": "ERR_REQUIRED",
        "field": "email",
        "message": "The email field is required."
    }

```

