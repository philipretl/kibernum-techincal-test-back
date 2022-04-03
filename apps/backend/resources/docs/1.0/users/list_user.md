<p align="center"><a href="https://colombia.kibernum.com/"><img src="	https://colombia.kibernum.com/wp-content/uploads/2019/10/logo-kibernum-nuevo-servicios-2.png" width="300" alt="Mallpty"></a>
</p>

*** 
# API Docs list users.

- [Base Url](#base_url)
- [Request Parameters](#request_parameters)
- [Responses](#response)
- [Success Responses](#success)

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
|GET|`/api/v1/users/list`|

|Headers|
|:-|
|[`Accept: application/json`]|

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
    "success": true,
    "description": "Empty list of users in kibernum technical test.",
    "data": {},
    "errors": [],
    "messages": [
        {
            "code_message": "EMPTY_LIST",
            "message": "Empty model list solicited."
        }
    ]
}
```
### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`EMPTY_LIST`|Empty model list solicited.|


## Response possibility #2

<larecipe-progress type="success" :value="100"></larecipe-progress>


###Code `200` `Ok`

###Content

```json
{
      "success": true,
      "description": "List of users in kibernum technical test.",
      "data": {
          "users":[
              {
                  "id": "1",
                  "name": "Juan",
                  "avatar": "https://avatars.dicebear.com/api/adventurer-neutral/juan.svg",
                  "created_at": "2022-04-01T05:59:10.185Z"
              },
              {
                  "id": "2",
                  "name": "Juan Pablo",
                  "avatar": "https://avatars.dicebear.com/api/adventurer-neutral/pablo.svg",
                  "created_at": "2022-04-01T01:03:12.818Z"
              }
          ]
      },
      "errors": [],
      "messages": [
        {
          "message_code": "SIMPLE_LIST",
          "message": "Simple data list."
        }
      ]
}
```
### Messages

<larecipe-badge type="info" circle icon="fa fa-commenting-o"></larecipe-badge> 

|message_code|message|
|:-|:-|
|`SIMPLE_LIST`|Simple data list.|

---

