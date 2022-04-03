<p align="center"><a href="https://colombia.kibernum.com/"><img src="	https://colombia.kibernum.com/wp-content/uploads/2019/10/logo-kibernum-nuevo-servicios-2.png" width="300" alt="Mallpty"></a>
</p>

*** 

# API Docs register user.

- [Base Url](#base_url)
- [Request Parameters](#request_parameters)
- [Responses](#response)
- [Success Responses](#success)
- [Error Responses](#error)

<a name="base_url"></a>
## Base Url
### This depends on the url of your project if it is production or local development

### Local with docker
```text
http://localhost:8082
```

### Test
```text
http://back-kibernum.venoudev.com
```

<a name="request_parameters"></a>
## Request Parameters

### Endpoint

|Method|URI|
|:-|:-|:-|
|POST|`/api/v1/users/register`|

|Headers|
|:-|
|[`Accept: application/json`]|

### Body 

```json
{
    "name"         : "string", 
    "avatar"       : "url"
}
```

<a name="response"></a>

## Responses

<a name="success"></a>

> {success} Success Responses

## Response possibility #1

<larecipe-progress type="success" :value="100"></larecipe-progress>


###Code `200` `Ok`

###Content

```json
{
    "success" : true,
    "description": "Owner registered in 4 ruedas successfully.",
    "data" : {
        "user":{
            "id": "92",
            "name": "Andres",
            "avatar": "https://i.pravatar.cc/300",
            "created_at": "2022-04-01T11:33:26.528Z"
        },
        "errors":[],
        "messages":[
            {
                "message_code":"REGISTERED", 
                "message":"Process Completed."
            }
        ]
}
```
### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`REGISTERED`|Process completed.|


<a name="error"></a>

> {danger} Error Responses

## Response possibility #1

<larecipe-progress type="danger" :value="100"></larecipe-progress>


###Code `400` `Bad Request`

###Content

```json
{
    "success": false,
    "description": "Exist conflict with the request, please check the errors or messages.",
    "data": {},
    "errors": [
        //errors
    ],
    "messages": [
        //messages
    ]
}
``` 

### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`CHECK_DATA`|The form has errors whit the inputs.|

### Errors

<larecipe-badge type="danger" circle icon="fa fa-exclamation-triangle"></larecipe-badge> 

|error_code|field|message|
|:-|:-|:-|
|`REQUIRED`|`name`|The name field is required.|
|`REQUIRED`|`avatar`|The avatar field is required.|
|`URL`|`avatar`|The avatar format is invalid.|
|`MAX_STRING`|`name`|The name may not be greater than 50 characters.|



