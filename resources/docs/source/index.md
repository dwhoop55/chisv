---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://chisv.org/docs/collection.json)

<!-- END_INFO -->

#Assignment


<!-- START_7a258424680b47d440023731a4e0be3e -->
## Create an assignment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/assignment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"user_id":1,"task_id":1}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/assignment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "user_id": 1,
    "task_id": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Assignment created"
}
```

### HTTP Request
`POST api/v1/assignment`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `user_id` | integer |  required  | The associated user by id
        `task_id` | integer |  required  | The associated task by id
    
<!-- END_7a258424680b47d440023731a4e0be3e -->

<!-- START_7d20a674615f823ca955430b9ac0ebe1 -->
## Update an assignment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/assignment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"hours":5.5,"state_id":43}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/assignment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "hours": 5.5,
    "state_id": 43
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Assignment] 1"
}
```

### HTTP Request
`PUT api/v1/assignment/{assignment}`

`PATCH api/v1/assignment/{assignment}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `assignment` |  required  | The assignment's id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `hours` | float |  required  | The accounted hours
        `state_id` | integer |  required  | The new [state](#get-all-states) by id
    
<!-- END_7d20a674615f823ca955430b9ac0ebe1 -->

<!-- START_08760017a44835569ff03aaa51b16be8 -->
## Delete an assignment

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/assignment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/assignment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Assignment] 1"
}
```

### HTTP Request
`DELETE api/v1/assignment/{assignment}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `assignment` |  required  | The assignment's id

<!-- END_08760017a44835569ff03aaa51b16be8 -->

#Authentication


<!-- START_8c0e48cd8efa861b308fc45872ff0837 -->
## Issue a JWT token for a user
Call without any existing Bearer token (remove from example). Will issue a JWT token (access_token) via the OAuth API by using the password_grant type.

> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"email":"admin@chisv.org","password":"secret"}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "email": "admin@chisv.org",
    "password": "secret"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "token_type": "Bearer",
    "expires_in": 31536000,
    "access_token": "eyJ0eX...3vE8",
    "refresh_token": "def50...9c2"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ]
    }
}
```

### HTTP Request
`POST api/v1/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The user's email
        `password` | string |  required  | The user's password
    
<!-- END_8c0e48cd8efa861b308fc45872ff0837 -->

#Bid


<!-- START_a9a4a5979919df0c5e0e18a1a69536ca -->
## Create multiple bids at once by params

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/bid/multi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"conference_id":"1","search":"A","days":["2020-07-01","2020-07-02"],"priorities":[1,2,3],"interval":["07:00:00","20:15:00"],"preference":1}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/bid/multi"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "conference_id": "1",
    "search": "A",
    "days": [
        "2020-07-01",
        "2020-07-02"
    ],
    "priorities": [
        1,
        2,
        3
    ],
    "interval": [
        "07:00:00",
        "20:15:00"
    ],
    "preference": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "created": 15,
    "updated": 2,
    "untouched": 0,
    "revoked": 0
}
```
> Example response (403):

```json
{
    "message": "You are not an SV with state accepted for this conference"
}
```

### HTTP Request
`POST api/v1/bid/multi`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `conference_id` | required |  optional  | The conference's id
        `search` | string |  optional  | Search string
        `days` | array&lt;string&gt; |  required  | Array of strings. Limit to array of specific days YYYY-MM-DD
        `days[0]` | string |  optional  | A day
        `days[1]` | string |  optional  | A day
        `priorities` | array&lt;int&gt; |  required  | Array of ints. Limit to array of specific priorities
        `priorities[0]` | integer |  optional  | A priority
        `priorities[1]` | integer |  optional  | A priority
        `priorities[2]` | integer |  optional  | A priority
        `interval` | array&lt;string&gt; |  required  | Array of strings. Limit the time, has two items
        `interval[0]` | string |  required  | Start time
        `interval[1]` | string |  required  | End time
        `preference` | integer |  optional  | Set to preference 0-3 or null/do not sent to revoke bids
    
<!-- END_a9a4a5979919df0c5e0e18a1a69536ca -->

<!-- START_9fce453a3e595aade744fb3fc0a0e2e9 -->
## Create a bid (place a bid)

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/bid" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"task_id":117,"preference":19}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/bid"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "task_id": 117,
    "preference": 19
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": {
        "id": 852,
        "preference": 1,
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        },
        "can_update": true
    },
    "message": "Bid created"
}
```
> Example response (403):

```json
{
    "message": "You are not authorized to create a bid for this task"
}
```

### HTTP Request
`POST api/v1/bid`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `task_id` | integer |  required  | The task to bid on by id
        `preference` | integer |  required  | The desired preference (0-3)
    
<!-- END_9fce453a3e595aade744fb3fc0a0e2e9 -->

<!-- START_5811c4a814de9e3ff677353e5c4301be -->
## Update a bid

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/bid/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"preference":1}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/bid/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "preference": 1
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": {
        "id": 853,
        "preference": 2,
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        },
        "can_update": true
    },
    "message": "Bid updated"
}
```
> Example response (403):

```json
{
    "message": "You are not authorized to update this bid"
}
```

### HTTP Request
`PUT api/v1/bid/{bid}`

`PATCH api/v1/bid/{bid}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `bid` |  required  | The bid's id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `preference` | integer |  required  | The desired preference (0-3)
    
<!-- END_5811c4a814de9e3ff677353e5c4301be -->

<!-- START_74ccf8c879de4a05e19be109ef3f3031 -->
## Delete a bid (revoke)

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/bid/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/bid/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (403):

```json
{
    "message": "This action is unauthorized."
}
```

### HTTP Request
`DELETE api/v1/bid/{bid}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `bid` |  required  | The bid's id

<!-- END_74ccf8c879de4a05e19be109ef3f3031 -->

#Calendar


<!-- START_9138d29dfb0e2d156770317318a71746 -->
## Get all calendar events

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/calendar_event?start=2019-01-01&end=2024-01-01" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/calendar_event"
);

let params = {
    "start": "2019-01-01",
    "end": "2024-01-01",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "assignments": []
}
```

### HTTP Request
`GET api/v1/calendar_event`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `start` |  optional  | string required the start time of events
    `end` |  optional  | string required the end time of events

<!-- END_9138d29dfb0e2d156770317318a71746 -->

#Conference


<!-- START_2e83181b692a4c6e06e67e83ff01e3a7 -->
## Get a preview of all open conferences for public display

> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/preview" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/preview"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "CHI 2020",
        "location": "Honolulu, Hawaiʻi, USA",
        "state_id": 4,
        "icon": null,
        "artwork": null,
        "state": {
            "id": 4,
            "name": "running",
            "for": "App\\Conference",
            "description": "The conference is running"
        }
    }
]
```

### HTTP Request
`GET api/v1/conference/preview`


<!-- END_2e83181b692a4c6e06e67e83ff01e3a7 -->

<!-- START_26469f0e30c54012b5528c0375f72106 -->
## Create a notification for users of a conference

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/notification" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"destinations":[{"type":"user","user_id":1},{"type":"group","role_id":10,"state_id":12},{"type":"email","email":"test@example.com"}],"elements":[{"type":"action","data":{"caption":"CHISV Website","url":"https:\/\/chisv.org"}},{"type":"markdown","data":"!See text below"}],"subject":"Announcement","greeting":"Hi!","salutation":"Cheers"}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/notification"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "destinations": [
        {
            "type": "user",
            "user_id": 1
        },
        {
            "type": "group",
            "role_id": 10,
            "state_id": 12
        },
        {
            "type": "email",
            "email": "test@example.com"
        }
    ],
    "elements": [
        {
            "type": "action",
            "data": {
                "caption": "CHISV Website",
                "url": "https:\/\/chisv.org"
            }
        },
        {
            "type": "markdown",
            "data": "!See text below"
        }
    ],
    "subject": "Announcement",
    "greeting": "Hi!",
    "salutation": "Cheers"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "12 users will be notified via the available channels (e.g. email, web notification system). You may check 'Background Jobs'."
}
```

### HTTP Request
`POST api/v1/conference/{conference}/notification`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference to get by key
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `destinations` | array |  required  | Multiple destinations, see below for 3 examples
        `destinations[0].type` | string |  required  | One of 'user', 'group' or 'email'
        `destinations[1].type` | string |  required  | One of 'user', 'group' or 'email'
        `destinations[2].type` | string |  required  | One of 'user', 'group' or 'email'
        `destinations[0].user_id` | integer |  optional  | Is required if type is 'user' pointing to the user by id
        `destinations[1].role_id` | integer |  optional  | Is required if type is 'group' pointing to the role by id
        `destinations[1].state_id` | integer |  optional  | Used if type is 'group' pointing to the state by id
        `destinations[2].email` | string |  optional  | Used if type is 'email' and is the (external) user's email
        `elements` | array |  required  | Multiple elements, see below for action and markdown below
        `elements[0].type` | required |  optional  | One of 'action', 'markdown'
        `elements[1].type` | required |  optional  | One of 'action', 'markdown'
        `elements[0].data.caption` | string |  optional  | Is required if type is 'action'
        `elements[0].data.url` | string |  optional  | Is required if type is 'action'
        `elements[1].data` | string |  optional  | Is required if type is 'markdown'
        `subject` | string |  optional  | 
        `greeting` | string |  optional  | 
        `salutation` | string |  optional  | 
    
<!-- END_26469f0e30c54012b5528c0375f72106 -->

<!-- START_6f994d80b087d97a28f05807f764d427 -->
## Create or update multiple tasks by import

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/task" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/task"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": 1,
    "message": "Task import for CHI 2020 has been queued as a new job"
}
```

### HTTP Request
`POST api/v1/conference/{conference}/task`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key

<!-- END_6f994d80b087d97a28f05807f764d427 -->

<!-- START_f64e5ca08b84e78958c7662c1d09e175 -->
## Enroll a user to be an SV for the conference with state &#039;enrolled&#039;
Use a dictionary of field names as keys value pairs.
Use the field names from the currently active enrollment form. The
fields below are just examples.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/enroll/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"id":1,"":{"fields":"perferendis"}}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/enroll/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "id": 1,
    "": {
        "fields": "perferendis"
    }
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "You are now enrolled"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "why_you_want_to_be_sv": [
            "'Why You Want To Be Sv' has to have some text",
            "'Why You Want To Be Sv' has to be provided"
        ]
    }
}
```

### HTTP Request
`POST api/v1/conference/{conference}/enroll/{user?}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
    `user` |  optional  | The user's id. Defaults to the authenticated user when missing
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | The referencing enrollment form id.
        `[fields]` | type |  required  | Each field of the referencing enrollment form. Can be multiple and is highly dynamic.
    
<!-- END_f64e5ca08b84e78958c7662c1d09e175 -->

<!-- START_7f0a19b80f91e8103d71c08929879ce4 -->
## Unenrolls a user from the conference

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/conference/chi20/enroll/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/enroll/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "You are now longer enrolled"
}
```

### HTTP Request
`DELETE api/v1/conference/{conference}/enroll/{user?}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
    `user` |  optional  | The user's id. Defaults to the authenticated user when missing

<!-- END_7f0a19b80f91e8103d71c08929879ce4 -->

<!-- START_0667c97952d689c7b7f3678408614889 -->
## Run the auction

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/auction/2020-07-01" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/auction/2020-07-01"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": 1,
    "message": "Auction for CHI 2020 on 2020-07-01 has been queued as a new job"
}
```

### HTTP Request
`POST api/v1/conference/{conference}/auction/{day}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
    `day` |  required  | The day to run the auction for

<!-- END_0667c97952d689c7b7f3678408614889 -->

<!-- START_1c60d0e5f7c369f2025c4ea4cc372f15 -->
## Run the lottery

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/conference/chi20/lottery" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/lottery"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": 1,
    "message": "Lottery for CHI 2020 has been queued as a new job"
}
```

### HTTP Request
`POST api/v1/conference/{conference}/lottery`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key

<!-- END_1c60d0e5f7c369f2025c4ea4cc372f15 -->

<!-- START_b5f90a2ec554bb6daa8173c4a87692cd -->
## Update enrollment form weights based on submitted weights
Use a dictionary of field names as keys value pairs.
Use the field names from the currently active enrollment form. The
fields below are just examples.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/conference/chi20/update_enrollment_form_weights" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"attended_before":5,"know_city":-15,"need_visa":0,"sved_before":30}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/update_enrollment_form_weights"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "attended_before": 5,
    "know_city": -15,
    "need_visa": 0,
    "sved_before": 30
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Updated 11 enrollment forms weights"
}
```

### HTTP Request
`PUT api/v1/conference/{conference}/update_enrollment_form_weights`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `attended_before` | integer |  required  | An example field
        `know_city` | integer |  required  | An example field
        `need_visa` | integer |  required  | An example field
        `sved_before` | integer |  required  | An example field
    
<!-- END_b5f90a2ec554bb6daa8173c4a87692cd -->

<!-- START_6104d8e4f50d52e65ddd056fc3c09cb7 -->
## Reset all SVs to &#039;enrolled&#039; state

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/conference/chi20/reset_enrollments_to_enrolled" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/reset_enrollments_to_enrolled"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": 11,
    "message": "11 SVs have been reset to state 'enrolled'"
}
```

### HTTP Request
`PUT api/v1/conference/{conference}/reset_enrollments_to_enrolled`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key

<!-- END_6104d8e4f50d52e65ddd056fc3c09cb7 -->

<!-- START_5f265df5c8e32f6d8a255cfba0c3c763 -->
## Delete all assignments for the specified day

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/conference/chi20/assignments/2020-12-25" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/assignments/2020-12-25"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": 0,
    "message": "0 assignments have been deleted. 0 bids have been reset to 'placed'"
}
```

### HTTP Request
`DELETE api/v1/conference/{conference}/assignments/{date}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
    `date` |  required  | Date in YYYY-MM-DD format

<!-- END_5f265df5c8e32f6d8a255cfba0c3c763 -->

<!-- START_376d3892b6c4a9cb6a0469e54f1bef86 -->
## Delete all tasks for specified days

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/conference/chi20/tasks?days=%5B%222020-12-25%22%2C%222020-12-26%22%5D" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/tasks"
);

let params = {
    "days": "["2020-12-25","2020-12-26"]",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": 0,
    "message": "0 tasks, 0 bids and 0 assignments have been deleted"
}
```

### HTTP Request
`DELETE api/v1/conference/{conference}/tasks`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `days` |  required  | Array of strings of all days in JSON

<!-- END_376d3892b6c4a9cb6a0469e54f1bef86 -->

<!-- START_f57466b20b11f44b3b332f1ec8380887 -->
## Get all days where the conference has tasks
We need this for the calendar in the GUI

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/task/day" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/task/day"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "2020-07-04": "76",
    "2020-07-05": "84",
    "2020-07-06": "91",
    "2020-07-07": "83",
    "2020-07-08": "89",
    "2020-07-09": "77"
}
```

### HTTP Request
`GET api/v1/conference/{conference}/task/day`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key

<!-- END_f57466b20b11f44b3b332f1ec8380887 -->

<!-- START_d690463ccada559b947de653028cdd43 -->
## Get all tasks which match the query

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/task?search=A&days=%5B%222020-07-01%22%2C+%222020-07-03%22%5D&priorities=%5B1%2C2%2C3%5D&interval=%5B%2207%3A00%3A00%22%2C+%2220%3A15%3A00%22%5D&sort_by=tasks.start_at&sort_order=asc&per_page=5&page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/task"
);

let params = {
    "search": "A",
    "days": "["2020-07-01", "2020-07-03"]",
    "priorities": "[1,2,3]",
    "interval": "["07:00:00", "20:15:00"]",
    "sort_by": "tasks.start_at",
    "sort_order": "asc",
    "per_page": "5",
    "page": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [],
    "first_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/task?page=1",
    "from": null,
    "last_page": 1,
    "last_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/task?page=1",
    "next_page_url": null,
    "path": "http:\/\/localhost\/api\/v1\/conference\/chi20\/task",
    "per_page": "5",
    "prev_page_url": null,
    "to": null,
    "total": 0
}
```

### HTTP Request
`GET api/v1/conference/{conference}/task`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `search` |  optional  | string Search string
    `days` |  optional  | array of strings. Limit to array of specific days YYYY-MM-DD
    `priorities` |  optional  | array of ints. Limit to array of specific priorities
    `interval` |  optional  | array of strings. Limit the time, has two items
    `sort_by` |  optional  | Key to sort for
    `sort_order` |  optional  | Order to sort for
    `per_page` |  optional  | Tasks per page
    `page` |  optional  | Page to return

<!-- END_d690463ccada559b947de653028cdd43 -->

<!-- START_fc38d63ae1427b7be3f95298245dd14a -->
## Get all assignments and users which match the query

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/assignment?search=A&day=2020-07-01&interval=%5B%2207%3A00%3A00%22%2C+%2220%3A15%3A00%22%5D&sort_by=start_at&sort_order=asc&per_page=5&page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/assignment"
);

let params = {
    "search": "A",
    "day": "2020-07-01",
    "interval": "["07:00:00", "20:15:00"]",
    "sort_by": "start_at",
    "sort_order": "asc",
    "per_page": "5",
    "page": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "users": [],
    "tasks": [],
    "total": 0
}
```

### HTTP Request
`GET api/v1/conference/{conference}/assignment`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `search` |  optional  | string Search string
    `day` |  optional  | string Limit to specific day YYYY-MM-DD
    `interval` |  optional  | array<string> Limit the time, has two items
    `sort_by` |  optional  | Key to sort for
    `sort_order` |  optional  | Order to sort for
    `per_page` |  optional  | Assignments per page
    `page` |  optional  | Assignments per page

<!-- END_fc38d63ae1427b7be3f95298245dd14a -->

<!-- START_25b5224247b0362ec3ea9ef90301c651 -->
## Get all users of a conference matching the query

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/sv?search=A&only_states=%5B11%2C12%2C13%2C14%5D&sort_by=lastname&sort_order=desc&per_page=2&page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/sv"
);

let params = {
    "search": "A",
    "only_states": "[11,12,13,14]",
    "sort_by": "lastname",
    "sort_order": "desc",
    "per_page": "2",
    "page": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "firstname": "Dortha",
            "lastname": "Waters",
            "id": 2,
            "avatar": null,
            "university": "All India Institute of Medical Sciences",
            "permission": {
                "state": {
                    "id": 12,
                    "name": "accepted",
                    "description": "Accepted to the conference as SV"
                },
                "id": 2,
                "lottery_position": null,
                "created_at": "2020-07-07 14:53:12",
                "enrollment_form": {
                    "name": "Default",
                    "id": 3,
                    "parent_id": 1,
                    "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":true,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":30,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":23,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":false,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"Omnis excepturi explicabo fuga. Vel facilis in nesciunt repudiandae qui quaerat minus. Ab amet nisi ea ipsa. Quas sit nihil assumenda optio quae.\",\"required\":true}}}",
                    "total_weight": 0
                },
                "conference": {
                    "id": 1
                },
                "role": {
                    "id": 10
                }
            },
            "country": "Azerbaijan",
            "region": "Bethlehem",
            "stats": {
                "assignments": {
                    "count": 0,
                    "done": 0
                },
                "hours_done": 0,
                "bids_placed": {
                    "unavailable": 2,
                    "low": 57,
                    "medium": 60,
                    "high": 41
                },
                "bids_successful": {
                    "low": 0,
                    "medium": 0,
                    "high": 0
                },
                "bids_conflict": {
                    "low": 0,
                    "medium": 0,
                    "high": 0
                }
            },
            "assignments": [],
            "past_conferences": [
                "UIST2020",
                "DIS 2014",
                "CHI19"
            ],
            "past_conferences_sv": [
                "UIST2020",
                "MobileHCI",
                "CHI19"
            ],
            "languages": [
                {
                    "id": 12,
                    "name": "Bulgarian"
                },
                {
                    "id": 123,
                    "name": "Tsonga"
                }
            ],
            "email": "tgleason@example.org",
            "degree": "PhD - 3rd year",
            "city": "Kemise",
            "notes": []
        },
        {
            "firstname": "Milton",
            "lastname": "Waddams",
            "id": 1,
            "avatar": null,
            "university": "Rajasthan Technical University",
            "permission": {
                "state": {
                    "id": 12,
                    "name": "accepted",
                    "description": "Accepted to the conference as SV"
                },
                "id": 1,
                "lottery_position": null,
                "created_at": "2020-07-07 14:53:12",
                "enrollment_form": {
                    "name": "Default",
                    "id": 2,
                    "parent_id": 1,
                    "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":true,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":14,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":26,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":false,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"Error sint qui vel ipsam. Sequi optio rerum et praesentium asperiores sequi non. Et voluptatem est odit totam voluptatem culpa accusantium.\",\"required\":true}}}",
                    "total_weight": 0
                },
                "conference": {
                    "id": 1
                },
                "role": {
                    "id": 10
                }
            },
            "country": "Germany",
            "region": "North Rhine-Westphalia",
            "stats": {
                "assignments": {
                    "count": 0,
                    "done": 0
                },
                "hours_done": 0,
                "bids_placed": {
                    "unavailable": 3,
                    "low": 51,
                    "medium": 47,
                    "high": 37
                },
                "bids_successful": {
                    "low": 0,
                    "medium": 0,
                    "high": 0
                },
                "bids_conflict": {
                    "low": 0,
                    "medium": 0,
                    "high": 0
                }
            },
            "assignments": [],
            "past_conferences": null,
            "past_conferences_sv": null,
            "languages": [
                {
                    "id": 10,
                    "name": "Bashkir"
                },
                {
                    "id": 13,
                    "name": "Bihari"
                }
            ],
            "email": "admin@chisv.org",
            "degree": "Master",
            "city": "Aachen",
            "notes": []
        }
    ],
    "first_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/sv?page=1",
    "from": 1,
    "last_page": 6,
    "last_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/sv?page=6",
    "next_page_url": "http:\/\/localhost\/api\/v1\/conference\/chi20\/sv?page=2",
    "path": "http:\/\/localhost\/api\/v1\/conference\/chi20\/sv",
    "per_page": "2",
    "prev_page_url": null,
    "to": 2,
    "total": 11
}
```

### HTTP Request
`GET api/v1/conference/{conference}/sv`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `search` |  optional  | string Search string
    `only_states` |  optional  | array of ints. Limit to array of specific states
    `sort_by` |  optional  | Key to sort for
    `sort_order` |  optional  | Order to sort for
    `per_page` |  optional  | Users per page
    `page` |  optional  | Page to return

<!-- END_25b5224247b0362ec3ea9ef90301c651 -->

<!-- START_7ade2e103f429985475bfd7e5f3e1d32 -->
## Get all users which are suited to be assigned for a specific task

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/sv_for_task_assignment/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/sv_for_task_assignment/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "total_matches": 11,
    "returned_matches": 10,
    "svs": [
        {
            "id": 7,
            "firstname": "Remington",
            "lastname": "Volkman",
            "bid": {
                "id": 911,
                "preference": 3,
                "user_created": false
            },
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 5,
                    "low": 50,
                    "medium": 46,
                    "high": 55
                }
            }
        },
        {
            "id": 8,
            "firstname": "Hollis",
            "lastname": "Haag",
            "bid": {
                "id": 1067,
                "preference": 2,
                "user_created": false
            },
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 5,
                    "low": 44,
                    "medium": 47,
                    "high": 45
                }
            }
        },
        {
            "id": 10,
            "firstname": "Pauline",
            "lastname": "Effertz",
            "bid": {
                "id": 1339,
                "preference": 2,
                "user_created": false
            },
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 1,
                    "low": 52,
                    "medium": 41,
                    "high": 42
                }
            }
        },
        {
            "id": 11,
            "firstname": "Ayla",
            "lastname": "Bergnaum",
            "bid": {
                "id": 1475,
                "preference": 2,
                "user_created": false
            },
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 1,
                    "low": 52,
                    "medium": 34,
                    "high": 46
                }
            }
        },
        {
            "id": 1,
            "firstname": "Milton",
            "lastname": "Waddams",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 3,
                    "low": 51,
                    "medium": 47,
                    "high": 37
                }
            }
        },
        {
            "id": 2,
            "firstname": "Dortha",
            "lastname": "Waters",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 2,
                    "low": 57,
                    "medium": 60,
                    "high": 41
                }
            }
        },
        {
            "id": 3,
            "firstname": "Jevon",
            "lastname": "Ortiz",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 3,
                    "low": 44,
                    "medium": 45,
                    "high": 58
                }
            }
        },
        {
            "id": 4,
            "firstname": "Noelia",
            "lastname": "Kassulke",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 5,
                    "low": 45,
                    "medium": 54,
                    "high": 48
                }
            }
        },
        {
            "id": 5,
            "firstname": "Elva",
            "lastname": "Gaylord",
            "bid": null,
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 0,
                    "low": 56,
                    "medium": 49,
                    "high": 40
                }
            }
        },
        {
            "id": 6,
            "firstname": "Hosea",
            "lastname": "Macejkovic",
            "bid": {
                "id": 746,
                "preference": 1,
                "user_created": false
            },
            "avatar": [],
            "stats": {
                "hours_done": 0,
                "hours_not_done": 0,
                "bids_placed": {
                    "unavailable": 5,
                    "low": 61,
                    "medium": 51,
                    "high": 48
                }
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/conference/{conference}/sv_for_task_assignment/{task}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
    `task` |  required  | The task's id

<!-- END_7ade2e103f429985475bfd7e5f3e1d32 -->

<!-- START_4fd9bbcd39c117c54c591475d46e0cec -->
## Get the number of accepted SVs

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/sv/count" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/sv/count"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": 11,
    "message": null
}
```

### HTTP Request
`GET api/v1/conference/{conference}/sv/count`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key

<!-- END_4fd9bbcd39c117c54c591475d46e0cec -->

<!-- START_d452bf9aacc3231cbeca5271a88f7359 -->
## Get all the possible notification destinations for a conference

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/destination" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/destination"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "groups": [
        {
            "role_id": 10,
            "type": "group",
            "display": "All SVs"
        },
        {
            "role_id": 10,
            "state_id": 12,
            "type": "group",
            "display": "Accepted SVs"
        },
        {
            "role_id": 10,
            "state_id": 13,
            "type": "group",
            "display": "Waitlisted SVs"
        },
        {
            "role_id": 3,
            "type": "group",
            "display": "Captains"
        }
    ],
    "users": [
        {
            "user_id": 1,
            "type": "user",
            "display": "Milton Waddams"
        },
        {
            "user_id": 2,
            "type": "user",
            "display": "Dortha Waters"
        },
        {
            "user_id": 3,
            "type": "user",
            "display": "Jevon Ortiz"
        },
        {
            "user_id": 4,
            "type": "user",
            "display": "Noelia Kassulke"
        },
        {
            "user_id": 5,
            "type": "user",
            "display": "Elva Gaylord"
        },
        {
            "user_id": 6,
            "type": "user",
            "display": "Hosea Macejkovic"
        },
        {
            "user_id": 7,
            "type": "user",
            "display": "Remington Volkman"
        },
        {
            "user_id": 8,
            "type": "user",
            "display": "Hollis Haag"
        },
        {
            "user_id": 9,
            "type": "user",
            "display": "Claire Beier"
        },
        {
            "user_id": 10,
            "type": "user",
            "display": "Pauline Effertz"
        },
        {
            "user_id": 11,
            "type": "user",
            "display": "Ayla Bergnaum"
        }
    ]
}
```

### HTTP Request
`GET api/v1/conference/{conference}/destination`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference to get by key

<!-- END_d452bf9aacc3231cbeca5271a88f7359 -->

<!-- START_d047bd6fd41efadb6c04fb272d06f398 -->
## Get all conferences based on user&#039;s permissions

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "CHI 2020",
        "key": "chi20",
        "location": "Honolulu, Hawaiʻi, USA",
        "timezone_id": 366,
        "start_date": "2020-07-04",
        "end_date": "2020-07-10",
        "description": "##Aloha!\n\nThe ACM CHI Conference on Human Factors in Computing Systems is the premier international conference of Human-Computer Interaction. __CHI__ – pronounced ‘kai’ – is a place where researchers and practitioners gather from across the world to discuss the latest in interactive technology. We are a multicultural community from highly diverse backgrounds who together investigate and design new and creative ways for people to interact using technology.\n\n###From April 25th to 30th\nCHI will, for the first time, take place in beautiful __Honolulu__, on the island of Oahu, Hawaiʻi, USA. Mahalo! Regina Bernhaupt and Florian ‘Floyd’ Mueller CHI 2020 General Chairs [generalchairs@chi2020.acm.org](mailto:generalchairs@chi2020.acm.org)",
        "enrollment_form_id": 1,
        "state_id": 4,
        "url": "https:\/\/www.acm.org\/",
        "url_name": "ACM",
        "created_at": "2020-07-07 14:53:10",
        "updated_at": "2020-07-07 14:53:10",
        "volunteer_hours": 20,
        "volunteer_max": 100,
        "email_chair": "noreply@chisv.org",
        "bidding_start": "2020-07-07 14:53:10",
        "bidding_end": "2020-07-10 00:00:00",
        "bidding_enabled": true,
        "icon": null,
        "artwork": null,
        "state": {
            "id": 4,
            "name": "running",
            "for": "App\\Conference",
            "description": "The conference is running"
        },
        "timezone": {
            "id": 366,
            "name": "Pacific\/Honolulu"
        }
    }
]
```

### HTTP Request
`GET api/v1/conference`


<!-- END_d047bd6fd41efadb6c04fb272d06f398 -->

<!-- START_f3a734edd078d86bac9e759001b1131b -->
## Create a conference

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/conference" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"name":"CHI 2021","key":"chi21"}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "name": "CHI 2021",
    "key": "chi21"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": {
        "name": "CHI 2021",
        "key": "chi21",
        "start_date": "2020-07-07",
        "end_date": "2020-07-08",
        "updated_at": "2020-07-07 14:57:09",
        "created_at": "2020-07-07 14:57:09",
        "id": 2
    },
    "message": "Conference created"
}
```

### HTTP Request
`POST api/v1/conference`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | The conference's full name
        `key` | string |  required  | The conference's key (part of URL). Has to be a valid in a URL
    
<!-- END_f3a734edd078d86bac9e759001b1131b -->

<!-- START_c508f5b8d74ec7e81d1746d1c00e2167 -->
## Get a conference by key

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 1,
    "name": "CHI 2020",
    "key": "chi20",
    "location": "Honolulu, Hawaiʻi, USA",
    "timezone_id": 366,
    "start_date": "2020-07-04",
    "end_date": "2020-07-10",
    "description": "##Aloha!\n\nThe ACM CHI Conference on Human Factors in Computing Systems is the premier international conference of Human-Computer Interaction. __CHI__ – pronounced ‘kai’ – is a place where researchers and practitioners gather from across the world to discuss the latest in interactive technology. We are a multicultural community from highly diverse backgrounds who together investigate and design new and creative ways for people to interact using technology.\n\n###From April 25th to 30th\nCHI will, for the first time, take place in beautiful __Honolulu__, on the island of Oahu, Hawaiʻi, USA. Mahalo! Regina Bernhaupt and Florian ‘Floyd’ Mueller CHI 2020 General Chairs [generalchairs@chi2020.acm.org](mailto:generalchairs@chi2020.acm.org)",
    "enrollment_form_id": 1,
    "state_id": 4,
    "url": "https:\/\/www.acm.org\/",
    "url_name": "ACM",
    "created_at": "2020-07-07 14:53:10",
    "updated_at": "2020-07-07 14:53:10",
    "volunteer_hours": 20,
    "volunteer_max": 100,
    "email_chair": "noreply@chisv.org",
    "bidding_start": "2020-07-07 14:53:10",
    "bidding_end": "2020-07-10 00:00:00",
    "bidding_enabled": true,
    "state": {
        "id": 4,
        "name": "running",
        "for": "App\\Conference",
        "description": "The conference is running"
    },
    "icon": null,
    "artwork": null,
    "timezone": {
        "id": 366,
        "name": "Pacific\/Honolulu"
    },
    "enrollment_form_template": {
        "id": 1,
        "name": "Default",
        "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":false,\"weight\":0,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":0,\"weight\":0,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":0,\"weight\":0,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":true,\"weight\":0,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"\",\"required\":true}}}"
    }
}
```

### HTTP Request
`GET api/v1/conference/{conference}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference to get by key

<!-- END_c508f5b8d74ec7e81d1746d1c00e2167 -->

<!-- START_2758127fe734b463e6ced325ab9bb9f1 -->
## Update a conference

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/conference/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"name":"CHI 2020","key":"chi20","location":"Hawaii","timezone_id":366,"start_date":"2020-07-01","end_date":"2020-07-07","description":"!CHI 2020","url_name":"ACM","url":"https:\/\/acm.org","enrollment_form_id":1,"state_id":2,"volunteer_hours":20,"volunteer_max":100,"email_chair":"sv@example.com","bidding_enabled":true,"bidding_start":"2020-07-01","bidding_end":"2020-07-07"}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "name": "CHI 2020",
    "key": "chi20",
    "location": "Hawaii",
    "timezone_id": 366,
    "start_date": "2020-07-01",
    "end_date": "2020-07-07",
    "description": "!CHI 2020",
    "url_name": "ACM",
    "url": "https:\/\/acm.org",
    "enrollment_form_id": 1,
    "state_id": 2,
    "volunteer_hours": 20,
    "volunteer_max": 100,
    "email_chair": "sv@example.com",
    "bidding_enabled": true,
    "bidding_start": "2020-07-01",
    "bidding_end": "2020-07-07"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Conference updated"
}
```
> Example response (404):

```json
{
    "message": "No query results for model [App\\Conference] chi404"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "description": [
            "Please give a short intro into the conference"
        ]
    }
}
```

### HTTP Request
`PUT api/v1/conference/{conference}`

`PATCH api/v1/conference/{conference}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Conference's name
        `key` | string |  required  | Conference's key
        `location` | string |  required  | Conference's location
        `timezone_id` | integer |  required  | Conference's timezone
        `start_date` | string |  required  | First day
        `end_date` | string |  required  | Last day
        `description` | string |  required  | Markdown description of the conference
        `url_name` | string |  required  | Caption for the button on the conference view
        `url` | string |  required  | Url for the button on the conference view
        `enrollment_form_id` | integer |  required  | Conference will use this enrollment form
        `state_id` | integer |  required  | State by id
        `volunteer_hours` | integer |  required  | How long SVs are expected to work
        `volunteer_max` | integer |  required  | How many SVs should be accepted for the conference
        `email_chair` | string |  required  | The SV-Chairs e-mail which is used in the reply field of every e-mail
        `bidding_enabled` | boolean |  required  | Bidding is enabled true/false
        `bidding_start` | string |  required  | Bidding open after this day
        `bidding_end` | string |  required  | Bidding open before this day
    
<!-- END_2758127fe734b463e6ced325ab9bb9f1 -->

<!-- START_1dcc9627334c1cfef9f9a8aa131da4d5 -->
## Delete a conference

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/conference/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "Conference deleted"
}
```

### HTTP Request
`DELETE api/v1/conference/{conference}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key

<!-- END_1dcc9627334c1cfef9f9a8aa131da4d5 -->

#Enrollment Form


<!-- START_1e9c98ffcccd3ea600f44f4de8acce1b -->
## Get all enrollment form templates

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/enrollment_form/template" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/enrollment_form/template"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "parent_id": null,
        "name": "Default",
        "is_template": 1,
        "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":false,\"weight\":0,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":0,\"weight\":0,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":0,\"weight\":0,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":true,\"weight\":0,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"\",\"required\":true}}}",
        "created_at": null,
        "updated_at": null,
        "total_weight": null
    }
]
```

### HTTP Request
`GET api/v1/enrollment_form/template`


<!-- END_1e9c98ffcccd3ea600f44f4de8acce1b -->

<!-- START_a6a10ba125c19027456c678b8fbc0e58 -->
## Update an enrollment form

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Use a dictionary of field names as keys value pairs.
Use the field names from the currently active enrollment form. The
fields below are just examples.

> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/enrollment_form/5" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"id":5,"attended_before":5,"know_city":0,"need_visa":0,"sved_before":2,"why_you_want_to_be_sv":"Like the cake"}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/enrollment_form/5"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "id": 5,
    "attended_before": 5,
    "know_city": 0,
    "need_visa": 0,
    "sved_before": 2,
    "why_you_want_to_be_sv": "Like the cake"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Form was updated!"
}
```

### HTTP Request
`PUT api/v1/enrollment_form/{enrollment_form}`

`PATCH api/v1/enrollment_form/{enrollment_form}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `enrollment_form` |  required  | The enrollment form's id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | The forms id
        `attended_before` | integer |  optional  | An example field
        `know_city` | integer |  optional  | An example field
        `need_visa` | integer |  optional  | An example field
        `sved_before` | integer |  optional  | An example field
        `why_you_want_to_be_sv` | string |  optional  | An example field
    
<!-- END_a6a10ba125c19027456c678b8fbc0e58 -->

#FAQ


<!-- START_25c8f8a17a9411876085853a3b9015b7 -->
## Get all FAQs

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/faq" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/faq"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "title": "How to log out?",
        "keywords": [
            "User",
            "Session"
        ],
        "view_count": 0
    }
]
```

### HTTP Request
`GET api/v1/faq`


<!-- END_25c8f8a17a9411876085853a3b9015b7 -->

<!-- START_9a955ed0f1eaa4dd4d3e07f65e62c468 -->
## Create an FAQ

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/faq" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"title":"How to logout","body":"You just click logout","role_id":10,"keywords":["Authentication","User"]}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/faq"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "title": "How to logout",
    "body": "You just click logout",
    "role_id": 10,
    "keywords": [
        "Authentication",
        "User"
    ]
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": {
        "id": 2,
        "title": "How to logout",
        "keywords": [
            "Authentication",
            "User"
        ],
        "body": "You just click logout",
        "view_count": 0,
        "role_id": 10
    },
    "message": "Faq created"
}
```

### HTTP Request
`POST api/v1/faq`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | The FAQ's title
        `body` | string |  required  | The FAQ's content
        `role_id` | integer |  optional  | The FAQ's required minimum role to view
        `keywords` | array |  required  | The FAQ's keywords
        `keywords[0]` | string |  optional  | A keyword
        `keywords[1]` | string |  optional  | A keyword
    
<!-- END_9a955ed0f1eaa4dd4d3e07f65e62c468 -->

<!-- START_02a474bbf51e7ce8e35a73cec4877094 -->
## Get an FAQ entry

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/faq/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/faq/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 1,
    "title": "How to log out?",
    "keywords": [
        "User",
        "Session"
    ],
    "body": "You just press the logout button.",
    "view_count": 1,
    "role_id": null,
    "role": null
}
```

### HTTP Request
`GET api/v1/faq/{faq}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `faq` |  required  | The FAQ's id

<!-- END_02a474bbf51e7ce8e35a73cec4877094 -->

<!-- START_9894be78b791ba8d6ca29155ab18e760 -->
## Update an FAQ

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/faq/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"title":"How to logout","body":"You just click logout","role_id":10,"keywords":["Authentication","User"]}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/faq/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "title": "How to logout",
    "body": "You just click logout",
    "role_id": 10,
    "keywords": [
        "Authentication",
        "User"
    ]
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": {
        "id": 1,
        "title": "How to logout",
        "keywords": [
            "Authentication",
            "User"
        ],
        "body": "You just click logout",
        "view_count": 0,
        "role_id": 10,
        "role": {
            "id": 10,
            "name": "sv",
            "description": "Is associated for conferences as SV"
        }
    },
    "message": "Faq updated"
}
```

### HTTP Request
`PUT api/v1/faq/{faq}`

`PATCH api/v1/faq/{faq}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `faq` |  required  | The FAQ's id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | The FAQ's title
        `body` | string |  required  | The FAQ's content
        `role_id` | integer |  optional  | The FAQ's required minimum role to view
        `keywords` | array |  required  | The FAQ's keywords
        `keywords[0]` | string |  optional  | A keyword
        `keywords[1]` | string |  optional  | A keyword
    
<!-- END_9894be78b791ba8d6ca29155ab18e760 -->

<!-- START_9b832ae5e450eab7da9bad731950513e -->
## Remove an FAQ

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/faq/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/faq/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Faq removed"
}
```

### HTTP Request
`DELETE api/v1/faq/{faq}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `faq` |  required  | The FAQ's id

<!-- END_9b832ae5e450eab7da9bad731950513e -->

#Generic Resources


<!-- START_25b8af9b90e055d9406bbfbb4b017c94 -->
## Get all locales

> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/locale" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/locale"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "code": "af",
        "name": "Afrikaans"
    },
    {
        "id": 2,
        "code": "sq",
        "name": "Albanian"
    },
    {
        "id": 3,
        "code": "ar",
        "name": "Arabic"
    },
    {
        "id": 127,
        "code": "yo",
        "name": "Yoruba Nigeria"
    },
    {
        "id": 128,
        "code": "ss",
        "name": "siSwati"
    }
]
```

### HTTP Request
`GET api/v1/locale`


<!-- END_25b8af9b90e055d9406bbfbb4b017c94 -->

<!-- START_aaaefa3727cedbf0d8299c07225811af -->
## Get all timezones

> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/timezone" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/timezone"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "Africa\/Abidjan"
    },
    {
        "id": 2,
        "name": "Africa\/Accra"
    },
    {
        "id": 3,
        "name": "Africa\/Algiers"
    },
    {
        "id": 4,
        "name": "Africa\/Bissau"
    },
    {
        "id": 5,
        "name": "Africa\/Cairo"
    },
    {
        "id": 6,
        "name": "Africa\/Casablanca"
    },
    {
        "id": 7,
        "name": "Africa\/Ceuta"
    },
    {
        "id": 8,
        "name": "Africa\/El_Aaiun"
    },
    {
        "id": 9,
        "name": "Africa\/Johannesburg"
    },
    {
        "id": 10,
        "name": "Africa\/Juba"
    },
    {
        "id": 11,
        "name": "Africa\/Khartoum"
    },
    {
        "id": 12,
        "name": "Africa\/Lagos"
    },
    {
        "id": 13,
        "name": "Africa\/Maputo"
    },
    {
        "id": 14,
        "name": "Africa\/Monrovia"
    },
    {
        "id": 15,
        "name": "Africa\/Nairobi"
    },
    {
        "id": 16,
        "name": "Africa\/Ndjamena"
    },
    {
        "id": 17,
        "name": "Africa\/Sao_Tome"
    },
    {
        "id": 18,
        "name": "Africa\/Tripoli"
    },
    {
        "id": 19,
        "name": "Africa\/Tunis"
    },
    {
        "id": 20,
        "name": "Africa\/Windhoek"
    },
    {
        "id": 21,
        "name": "America\/Adak"
    },
    {
        "id": 22,
        "name": "America\/Anchorage"
    },
    {
        "id": 23,
        "name": "America\/Araguaina"
    },
    {
        "id": 24,
        "name": "America\/Argentina\/Buenos_Aires"
    },
    {
        "id": 25,
        "name": "America\/Argentina\/Catamarca"
    },
    {
        "id": 26,
        "name": "America\/Argentina\/Cordoba"
    },
    {
        "id": 27,
        "name": "America\/Argentina\/Jujuy"
    },
    {
        "id": 28,
        "name": "America\/Argentina\/La_Rioja"
    },
    {
        "id": 29,
        "name": "America\/Argentina\/Mendoza"
    },
    {
        "id": 30,
        "name": "America\/Argentina\/Rio_Gallegos"
    },
    {
        "id": 31,
        "name": "America\/Argentina\/Salta"
    },
    {
        "id": 32,
        "name": "America\/Argentina\/San_Juan"
    },
    {
        "id": 33,
        "name": "America\/Argentina\/San_Luis"
    },
    {
        "id": 34,
        "name": "America\/Argentina\/Tucuman"
    },
    {
        "id": 35,
        "name": "America\/Argentina\/Ushuaia"
    },
    {
        "id": 36,
        "name": "America\/Asuncion"
    },
    {
        "id": 37,
        "name": "America\/Atikokan"
    },
    {
        "id": 38,
        "name": "America\/Bahia"
    },
    {
        "id": 39,
        "name": "America\/Bahia_Banderas"
    },
    {
        "id": 40,
        "name": "America\/Barbados"
    },
    {
        "id": 41,
        "name": "America\/Belem"
    },
    {
        "id": 42,
        "name": "America\/Belize"
    },
    {
        "id": 43,
        "name": "America\/Blanc-Sablon"
    },
    {
        "id": 44,
        "name": "America\/Boa_Vista"
    },
    {
        "id": 45,
        "name": "America\/Bogota"
    },
    {
        "id": 46,
        "name": "America\/Boise"
    },
    {
        "id": 47,
        "name": "America\/Cambridge_Bay"
    },
    {
        "id": 48,
        "name": "America\/Campo_Grande"
    },
    {
        "id": 49,
        "name": "America\/Cancun"
    },
    {
        "id": 50,
        "name": "America\/Caracas"
    },
    {
        "id": 51,
        "name": "America\/Cayenne"
    },
    {
        "id": 52,
        "name": "America\/Chicago"
    },
    {
        "id": 53,
        "name": "America\/Chihuahua"
    },
    {
        "id": 54,
        "name": "America\/Costa_Rica"
    },
    {
        "id": 55,
        "name": "America\/Creston"
    },
    {
        "id": 56,
        "name": "America\/Cuiaba"
    },
    {
        "id": 57,
        "name": "America\/Curacao"
    },
    {
        "id": 58,
        "name": "America\/Danmarkshavn"
    },
    {
        "id": 59,
        "name": "America\/Dawson"
    },
    {
        "id": 60,
        "name": "America\/Dawson_Creek"
    },
    {
        "id": 61,
        "name": "America\/Denver"
    },
    {
        "id": 62,
        "name": "America\/Detroit"
    },
    {
        "id": 63,
        "name": "America\/Edmonton"
    },
    {
        "id": 64,
        "name": "America\/Eirunepe"
    },
    {
        "id": 65,
        "name": "America\/El_Salvador"
    },
    {
        "id": 66,
        "name": "America\/Fort_Nelson"
    },
    {
        "id": 67,
        "name": "America\/Fortaleza"
    },
    {
        "id": 68,
        "name": "America\/Glace_Bay"
    },
    {
        "id": 69,
        "name": "America\/Godthab"
    },
    {
        "id": 70,
        "name": "America\/Goose_Bay"
    },
    {
        "id": 71,
        "name": "America\/Grand_Turk"
    },
    {
        "id": 72,
        "name": "America\/Guatemala"
    },
    {
        "id": 73,
        "name": "America\/Guayaquil"
    },
    {
        "id": 74,
        "name": "America\/Guyana"
    },
    {
        "id": 75,
        "name": "America\/Halifax"
    },
    {
        "id": 76,
        "name": "America\/Havana"
    },
    {
        "id": 77,
        "name": "America\/Hermosillo"
    },
    {
        "id": 78,
        "name": "America\/Indiana\/Indianapolis"
    },
    {
        "id": 79,
        "name": "America\/Indiana\/Knox"
    },
    {
        "id": 80,
        "name": "America\/Indiana\/Marengo"
    },
    {
        "id": 81,
        "name": "America\/Indiana\/Petersburg"
    },
    {
        "id": 82,
        "name": "America\/Indiana\/Tell_City"
    },
    {
        "id": 83,
        "name": "America\/Indiana\/Vevay"
    },
    {
        "id": 84,
        "name": "America\/Indiana\/Vincennes"
    },
    {
        "id": 85,
        "name": "America\/Indiana\/Winamac"
    },
    {
        "id": 86,
        "name": "America\/Inuvik"
    },
    {
        "id": 87,
        "name": "America\/Iqaluit"
    },
    {
        "id": 88,
        "name": "America\/Jamaica"
    },
    {
        "id": 89,
        "name": "America\/Juneau"
    },
    {
        "id": 90,
        "name": "America\/Kentucky\/Louisville"
    },
    {
        "id": 91,
        "name": "America\/Kentucky\/Monticello"
    },
    {
        "id": 92,
        "name": "America\/La_Paz"
    },
    {
        "id": 93,
        "name": "America\/Lima"
    },
    {
        "id": 94,
        "name": "America\/Los_Angeles"
    },
    {
        "id": 95,
        "name": "America\/Maceio"
    },
    {
        "id": 96,
        "name": "America\/Managua"
    },
    {
        "id": 97,
        "name": "America\/Manaus"
    },
    {
        "id": 98,
        "name": "America\/Martinique"
    },
    {
        "id": 99,
        "name": "America\/Matamoros"
    },
    {
        "id": 100,
        "name": "America\/Mazatlan"
    },
    {
        "id": 101,
        "name": "America\/Menominee"
    },
    {
        "id": 102,
        "name": "America\/Merida"
    },
    {
        "id": 103,
        "name": "America\/Metlakatla"
    },
    {
        "id": 104,
        "name": "America\/Mexico_City"
    },
    {
        "id": 105,
        "name": "America\/Miquelon"
    },
    {
        "id": 106,
        "name": "America\/Moncton"
    },
    {
        "id": 107,
        "name": "America\/Monterrey"
    },
    {
        "id": 108,
        "name": "America\/Montevideo"
    },
    {
        "id": 109,
        "name": "America\/Nassau"
    },
    {
        "id": 110,
        "name": "America\/New_York"
    },
    {
        "id": 111,
        "name": "America\/Nipigon"
    },
    {
        "id": 112,
        "name": "America\/Nome"
    },
    {
        "id": 113,
        "name": "America\/Noronha"
    },
    {
        "id": 114,
        "name": "America\/North_Dakota\/Beulah"
    },
    {
        "id": 115,
        "name": "America\/North_Dakota\/Center"
    },
    {
        "id": 116,
        "name": "America\/North_Dakota\/New_Salem"
    },
    {
        "id": 117,
        "name": "America\/Ojinaga"
    },
    {
        "id": 118,
        "name": "America\/Panama"
    },
    {
        "id": 119,
        "name": "America\/Pangnirtung"
    },
    {
        "id": 120,
        "name": "America\/Paramaribo"
    },
    {
        "id": 121,
        "name": "America\/Phoenix"
    },
    {
        "id": 122,
        "name": "America\/Port-au-Prince"
    },
    {
        "id": 123,
        "name": "America\/Port_of_Spain"
    },
    {
        "id": 124,
        "name": "America\/Porto_Velho"
    },
    {
        "id": 125,
        "name": "America\/Puerto_Rico"
    },
    {
        "id": 126,
        "name": "America\/Punta_Arenas"
    },
    {
        "id": 127,
        "name": "America\/Rainy_River"
    },
    {
        "id": 128,
        "name": "America\/Rankin_Inlet"
    },
    {
        "id": 129,
        "name": "America\/Recife"
    },
    {
        "id": 130,
        "name": "America\/Regina"
    },
    {
        "id": 131,
        "name": "America\/Resolute"
    },
    {
        "id": 132,
        "name": "America\/Rio_Branco"
    },
    {
        "id": 133,
        "name": "America\/Santarem"
    },
    {
        "id": 134,
        "name": "America\/Santiago"
    },
    {
        "id": 135,
        "name": "America\/Santo_Domingo"
    },
    {
        "id": 136,
        "name": "America\/Sao_Paulo"
    },
    {
        "id": 137,
        "name": "America\/Scoresbysund"
    },
    {
        "id": 138,
        "name": "America\/Sitka"
    },
    {
        "id": 139,
        "name": "America\/St_Johns"
    },
    {
        "id": 140,
        "name": "America\/Swift_Current"
    },
    {
        "id": 141,
        "name": "America\/Tegucigalpa"
    },
    {
        "id": 142,
        "name": "America\/Thule"
    },
    {
        "id": 143,
        "name": "America\/Thunder_Bay"
    },
    {
        "id": 144,
        "name": "America\/Tijuana"
    },
    {
        "id": 145,
        "name": "America\/Toronto"
    },
    {
        "id": 146,
        "name": "America\/Vancouver"
    },
    {
        "id": 147,
        "name": "America\/Whitehorse"
    },
    {
        "id": 148,
        "name": "America\/Winnipeg"
    },
    {
        "id": 149,
        "name": "America\/Yakutat"
    },
    {
        "id": 150,
        "name": "America\/Yellowknife"
    },
    {
        "id": 151,
        "name": "Antarctica\/Casey"
    },
    {
        "id": 152,
        "name": "Antarctica\/Davis"
    },
    {
        "id": 153,
        "name": "Antarctica\/DumontDUrville"
    },
    {
        "id": 154,
        "name": "Antarctica\/Macquarie"
    },
    {
        "id": 155,
        "name": "Antarctica\/Mawson"
    },
    {
        "id": 156,
        "name": "Antarctica\/Palmer"
    },
    {
        "id": 157,
        "name": "Antarctica\/Rothera"
    },
    {
        "id": 158,
        "name": "Antarctica\/Syowa"
    },
    {
        "id": 159,
        "name": "Antarctica\/Troll"
    },
    {
        "id": 160,
        "name": "Antarctica\/Vostok"
    },
    {
        "id": 161,
        "name": "Asia\/Almaty"
    },
    {
        "id": 162,
        "name": "Asia\/Amman"
    },
    {
        "id": 163,
        "name": "Asia\/Anadyr"
    },
    {
        "id": 164,
        "name": "Asia\/Aqtau"
    },
    {
        "id": 165,
        "name": "Asia\/Aqtobe"
    },
    {
        "id": 166,
        "name": "Asia\/Ashgabat"
    },
    {
        "id": 167,
        "name": "Asia\/Atyrau"
    },
    {
        "id": 168,
        "name": "Asia\/Baghdad"
    },
    {
        "id": 169,
        "name": "Asia\/Baku"
    },
    {
        "id": 170,
        "name": "Asia\/Bangkok"
    },
    {
        "id": 171,
        "name": "Asia\/Barnaul"
    },
    {
        "id": 172,
        "name": "Asia\/Beirut"
    },
    {
        "id": 173,
        "name": "Asia\/Bishkek"
    },
    {
        "id": 174,
        "name": "Asia\/Brunei"
    },
    {
        "id": 175,
        "name": "Asia\/Chita"
    },
    {
        "id": 176,
        "name": "Asia\/Choibalsan"
    },
    {
        "id": 177,
        "name": "Asia\/Colombo"
    },
    {
        "id": 178,
        "name": "Asia\/Damascus"
    },
    {
        "id": 179,
        "name": "Asia\/Dhaka"
    },
    {
        "id": 180,
        "name": "Asia\/Dili"
    },
    {
        "id": 181,
        "name": "Asia\/Dubai"
    },
    {
        "id": 182,
        "name": "Asia\/Dushanbe"
    },
    {
        "id": 183,
        "name": "Asia\/Famagusta"
    },
    {
        "id": 184,
        "name": "Asia\/Gaza"
    },
    {
        "id": 185,
        "name": "Asia\/Hebron"
    },
    {
        "id": 186,
        "name": "Asia\/Ho_Chi_Minh"
    },
    {
        "id": 187,
        "name": "Asia\/Hong_Kong"
    },
    {
        "id": 188,
        "name": "Asia\/Hovd"
    },
    {
        "id": 189,
        "name": "Asia\/Irkutsk"
    },
    {
        "id": 190,
        "name": "Asia\/Jakarta"
    },
    {
        "id": 191,
        "name": "Asia\/Jayapura"
    },
    {
        "id": 192,
        "name": "Asia\/Jerusalem"
    },
    {
        "id": 193,
        "name": "Asia\/Kabul"
    },
    {
        "id": 194,
        "name": "Asia\/Kamchatka"
    },
    {
        "id": 195,
        "name": "Asia\/Karachi"
    },
    {
        "id": 196,
        "name": "Asia\/Kathmandu"
    },
    {
        "id": 197,
        "name": "Asia\/Khandyga"
    },
    {
        "id": 198,
        "name": "Asia\/Kolkata"
    },
    {
        "id": 199,
        "name": "Asia\/Krasnoyarsk"
    },
    {
        "id": 200,
        "name": "Asia\/Kuala_Lumpur"
    },
    {
        "id": 201,
        "name": "Asia\/Kuching"
    },
    {
        "id": 202,
        "name": "Asia\/Macau"
    },
    {
        "id": 203,
        "name": "Asia\/Magadan"
    },
    {
        "id": 204,
        "name": "Asia\/Makassar"
    },
    {
        "id": 205,
        "name": "Asia\/Manila"
    },
    {
        "id": 206,
        "name": "Asia\/Nicosia"
    },
    {
        "id": 207,
        "name": "Asia\/Novokuznetsk"
    },
    {
        "id": 208,
        "name": "Asia\/Novosibirsk"
    },
    {
        "id": 209,
        "name": "Asia\/Omsk"
    },
    {
        "id": 210,
        "name": "Asia\/Oral"
    },
    {
        "id": 211,
        "name": "Asia\/Pontianak"
    },
    {
        "id": 212,
        "name": "Asia\/Pyongyang"
    },
    {
        "id": 213,
        "name": "Asia\/Qatar"
    },
    {
        "id": 214,
        "name": "Asia\/Qostanay"
    },
    {
        "id": 215,
        "name": "Asia\/Qyzylorda"
    },
    {
        "id": 216,
        "name": "Asia\/Riyadh"
    },
    {
        "id": 217,
        "name": "Asia\/Sakhalin"
    },
    {
        "id": 218,
        "name": "Asia\/Samarkand"
    },
    {
        "id": 219,
        "name": "Asia\/Seoul"
    },
    {
        "id": 220,
        "name": "Asia\/Shanghai"
    },
    {
        "id": 221,
        "name": "Asia\/Singapore"
    },
    {
        "id": 222,
        "name": "Asia\/Srednekolymsk"
    },
    {
        "id": 223,
        "name": "Asia\/Taipei"
    },
    {
        "id": 224,
        "name": "Asia\/Tashkent"
    },
    {
        "id": 225,
        "name": "Asia\/Tbilisi"
    },
    {
        "id": 226,
        "name": "Asia\/Tehran"
    },
    {
        "id": 227,
        "name": "Asia\/Thimphu"
    },
    {
        "id": 228,
        "name": "Asia\/Tokyo"
    },
    {
        "id": 229,
        "name": "Asia\/Tomsk"
    },
    {
        "id": 230,
        "name": "Asia\/Ulaanbaatar"
    },
    {
        "id": 231,
        "name": "Asia\/Urumqi"
    },
    {
        "id": 232,
        "name": "Asia\/Ust-Nera"
    },
    {
        "id": 233,
        "name": "Asia\/Vladivostok"
    },
    {
        "id": 234,
        "name": "Asia\/Yakutsk"
    },
    {
        "id": 235,
        "name": "Asia\/Yangon"
    },
    {
        "id": 236,
        "name": "Asia\/Yekaterinburg"
    },
    {
        "id": 237,
        "name": "Asia\/Yerevan"
    },
    {
        "id": 238,
        "name": "Atlantic\/Azores"
    },
    {
        "id": 239,
        "name": "Atlantic\/Bermuda"
    },
    {
        "id": 240,
        "name": "Atlantic\/Canary"
    },
    {
        "id": 241,
        "name": "Atlantic\/Cape_Verde"
    },
    {
        "id": 242,
        "name": "Atlantic\/Faroe"
    },
    {
        "id": 243,
        "name": "Atlantic\/Madeira"
    },
    {
        "id": 244,
        "name": "Atlantic\/Reykjavik"
    },
    {
        "id": 245,
        "name": "Atlantic\/South_Georgia"
    },
    {
        "id": 246,
        "name": "Atlantic\/Stanley"
    },
    {
        "id": 247,
        "name": "Australia\/Adelaide"
    },
    {
        "id": 248,
        "name": "Australia\/Brisbane"
    },
    {
        "id": 249,
        "name": "Australia\/Broken_Hill"
    },
    {
        "id": 250,
        "name": "Australia\/Currie"
    },
    {
        "id": 251,
        "name": "Australia\/Darwin"
    },
    {
        "id": 252,
        "name": "Australia\/Eucla"
    },
    {
        "id": 253,
        "name": "Australia\/Hobart"
    },
    {
        "id": 254,
        "name": "Australia\/Lindeman"
    },
    {
        "id": 255,
        "name": "Australia\/Lord_Howe"
    },
    {
        "id": 256,
        "name": "Australia\/Melbourne"
    },
    {
        "id": 257,
        "name": "Australia\/Perth"
    },
    {
        "id": 258,
        "name": "Australia\/Sydney"
    },
    {
        "id": 259,
        "name": "CET"
    },
    {
        "id": 260,
        "name": "CST6CDT"
    },
    {
        "id": 261,
        "name": "EET"
    },
    {
        "id": 262,
        "name": "EST"
    },
    {
        "id": 263,
        "name": "EST5EDT"
    },
    {
        "id": 264,
        "name": "Etc\/GMT"
    },
    {
        "id": 265,
        "name": "Etc\/GMT+1"
    },
    {
        "id": 266,
        "name": "Etc\/GMT+10"
    },
    {
        "id": 267,
        "name": "Etc\/GMT+11"
    },
    {
        "id": 268,
        "name": "Etc\/GMT+12"
    },
    {
        "id": 269,
        "name": "Etc\/GMT+2"
    },
    {
        "id": 270,
        "name": "Etc\/GMT+3"
    },
    {
        "id": 271,
        "name": "Etc\/GMT+4"
    },
    {
        "id": 272,
        "name": "Etc\/GMT+5"
    },
    {
        "id": 273,
        "name": "Etc\/GMT+6"
    },
    {
        "id": 274,
        "name": "Etc\/GMT+7"
    },
    {
        "id": 275,
        "name": "Etc\/GMT+8"
    },
    {
        "id": 276,
        "name": "Etc\/GMT+9"
    },
    {
        "id": 277,
        "name": "Etc\/GMT-1"
    },
    {
        "id": 278,
        "name": "Etc\/GMT-10"
    },
    {
        "id": 279,
        "name": "Etc\/GMT-11"
    },
    {
        "id": 280,
        "name": "Etc\/GMT-12"
    },
    {
        "id": 281,
        "name": "Etc\/GMT-13"
    },
    {
        "id": 282,
        "name": "Etc\/GMT-14"
    },
    {
        "id": 283,
        "name": "Etc\/GMT-2"
    },
    {
        "id": 284,
        "name": "Etc\/GMT-3"
    },
    {
        "id": 285,
        "name": "Etc\/GMT-4"
    },
    {
        "id": 286,
        "name": "Etc\/GMT-5"
    },
    {
        "id": 287,
        "name": "Etc\/GMT-6"
    },
    {
        "id": 288,
        "name": "Etc\/GMT-7"
    },
    {
        "id": 289,
        "name": "Etc\/GMT-8"
    },
    {
        "id": 290,
        "name": "Etc\/GMT-9"
    },
    {
        "id": 291,
        "name": "Etc\/UTC"
    },
    {
        "id": 292,
        "name": "Europe\/Amsterdam"
    },
    {
        "id": 293,
        "name": "Europe\/Andorra"
    },
    {
        "id": 294,
        "name": "Europe\/Astrakhan"
    },
    {
        "id": 295,
        "name": "Europe\/Athens"
    },
    {
        "id": 296,
        "name": "Europe\/Belgrade"
    },
    {
        "id": 297,
        "name": "Europe\/Berlin"
    },
    {
        "id": 298,
        "name": "Europe\/Brussels"
    },
    {
        "id": 299,
        "name": "Europe\/Bucharest"
    },
    {
        "id": 300,
        "name": "Europe\/Budapest"
    },
    {
        "id": 301,
        "name": "Europe\/Chisinau"
    },
    {
        "id": 302,
        "name": "Europe\/Copenhagen"
    },
    {
        "id": 303,
        "name": "Europe\/Dublin"
    },
    {
        "id": 304,
        "name": "Europe\/Gibraltar"
    },
    {
        "id": 305,
        "name": "Europe\/Helsinki"
    },
    {
        "id": 306,
        "name": "Europe\/Istanbul"
    },
    {
        "id": 307,
        "name": "Europe\/Kaliningrad"
    },
    {
        "id": 308,
        "name": "Europe\/Kiev"
    },
    {
        "id": 309,
        "name": "Europe\/Kirov"
    },
    {
        "id": 310,
        "name": "Europe\/Lisbon"
    },
    {
        "id": 311,
        "name": "Europe\/London"
    },
    {
        "id": 312,
        "name": "Europe\/Luxembourg"
    },
    {
        "id": 313,
        "name": "Europe\/Madrid"
    },
    {
        "id": 314,
        "name": "Europe\/Malta"
    },
    {
        "id": 315,
        "name": "Europe\/Minsk"
    },
    {
        "id": 316,
        "name": "Europe\/Monaco"
    },
    {
        "id": 317,
        "name": "Europe\/Moscow"
    },
    {
        "id": 318,
        "name": "Europe\/Oslo"
    },
    {
        "id": 319,
        "name": "Europe\/Paris"
    },
    {
        "id": 320,
        "name": "Europe\/Prague"
    },
    {
        "id": 321,
        "name": "Europe\/Riga"
    },
    {
        "id": 322,
        "name": "Europe\/Rome"
    },
    {
        "id": 323,
        "name": "Europe\/Samara"
    },
    {
        "id": 324,
        "name": "Europe\/Saratov"
    },
    {
        "id": 325,
        "name": "Europe\/Simferopol"
    },
    {
        "id": 326,
        "name": "Europe\/Sofia"
    },
    {
        "id": 327,
        "name": "Europe\/Stockholm"
    },
    {
        "id": 328,
        "name": "Europe\/Tallinn"
    },
    {
        "id": 329,
        "name": "Europe\/Tirane"
    },
    {
        "id": 330,
        "name": "Europe\/Ulyanovsk"
    },
    {
        "id": 331,
        "name": "Europe\/Uzhgorod"
    },
    {
        "id": 332,
        "name": "Europe\/Vienna"
    },
    {
        "id": 333,
        "name": "Europe\/Vilnius"
    },
    {
        "id": 334,
        "name": "Europe\/Volgograd"
    },
    {
        "id": 335,
        "name": "Europe\/Warsaw"
    },
    {
        "id": 336,
        "name": "Europe\/Zaporozhye"
    },
    {
        "id": 337,
        "name": "Europe\/Zurich"
    },
    {
        "id": 338,
        "name": "HST"
    },
    {
        "id": 339,
        "name": "Indian\/Chagos"
    },
    {
        "id": 340,
        "name": "Indian\/Christmas"
    },
    {
        "id": 341,
        "name": "Indian\/Cocos"
    },
    {
        "id": 342,
        "name": "Indian\/Kerguelen"
    },
    {
        "id": 343,
        "name": "Indian\/Mahe"
    },
    {
        "id": 344,
        "name": "Indian\/Maldives"
    },
    {
        "id": 345,
        "name": "Indian\/Mauritius"
    },
    {
        "id": 346,
        "name": "Indian\/Reunion"
    },
    {
        "id": 347,
        "name": "MET"
    },
    {
        "id": 348,
        "name": "MST"
    },
    {
        "id": 349,
        "name": "MST7MDT"
    },
    {
        "id": 350,
        "name": "PST8PDT"
    },
    {
        "id": 351,
        "name": "Pacific\/Apia"
    },
    {
        "id": 352,
        "name": "Pacific\/Auckland"
    },
    {
        "id": 353,
        "name": "Pacific\/Bougainville"
    },
    {
        "id": 354,
        "name": "Pacific\/Chatham"
    },
    {
        "id": 355,
        "name": "Pacific\/Chuuk"
    },
    {
        "id": 356,
        "name": "Pacific\/Easter"
    },
    {
        "id": 357,
        "name": "Pacific\/Efate"
    },
    {
        "id": 358,
        "name": "Pacific\/Enderbury"
    },
    {
        "id": 359,
        "name": "Pacific\/Fakaofo"
    },
    {
        "id": 360,
        "name": "Pacific\/Fiji"
    },
    {
        "id": 361,
        "name": "Pacific\/Funafuti"
    },
    {
        "id": 362,
        "name": "Pacific\/Galapagos"
    },
    {
        "id": 363,
        "name": "Pacific\/Gambier"
    },
    {
        "id": 364,
        "name": "Pacific\/Guadalcanal"
    },
    {
        "id": 365,
        "name": "Pacific\/Guam"
    },
    {
        "id": 366,
        "name": "Pacific\/Honolulu"
    },
    {
        "id": 367,
        "name": "Pacific\/Kiritimati"
    },
    {
        "id": 368,
        "name": "Pacific\/Kosrae"
    },
    {
        "id": 369,
        "name": "Pacific\/Kwajalein"
    },
    {
        "id": 370,
        "name": "Pacific\/Majuro"
    },
    {
        "id": 371,
        "name": "Pacific\/Marquesas"
    },
    {
        "id": 372,
        "name": "Pacific\/Nauru"
    },
    {
        "id": 373,
        "name": "Pacific\/Niue"
    },
    {
        "id": 374,
        "name": "Pacific\/Norfolk"
    },
    {
        "id": 375,
        "name": "Pacific\/Noumea"
    },
    {
        "id": 376,
        "name": "Pacific\/Pago_Pago"
    },
    {
        "id": 377,
        "name": "Pacific\/Palau"
    },
    {
        "id": 378,
        "name": "Pacific\/Pitcairn"
    },
    {
        "id": 379,
        "name": "Pacific\/Pohnpei"
    },
    {
        "id": 380,
        "name": "Pacific\/Port_Moresby"
    },
    {
        "id": 381,
        "name": "Pacific\/Rarotonga"
    },
    {
        "id": 382,
        "name": "Pacific\/Tahiti"
    },
    {
        "id": 383,
        "name": "Pacific\/Tarawa"
    },
    {
        "id": 384,
        "name": "Pacific\/Tongatapu"
    },
    {
        "id": 385,
        "name": "Pacific\/Wake"
    },
    {
        "id": 386,
        "name": "Pacific\/Wallis"
    },
    {
        "id": 387,
        "name": "WET"
    }
]
```

### HTTP Request
`GET api/v1/timezone`


<!-- END_aaaefa3727cedbf0d8299c07225811af -->

<!-- START_eb45f6491172f73ce8b9bab81dc33af2 -->
## Get all T-Shirts

> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/shirt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/shirt"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "cut": "Straight",
        "size": "S"
    },
    {
        "id": 2,
        "cut": "Straight",
        "size": "M"
    },
    {
        "id": 3,
        "cut": "Straight",
        "size": "L"
    },
    {
        "id": 4,
        "cut": "Straight",
        "size": "XL"
    },
    {
        "id": 5,
        "cut": "Straight",
        "size": "XXL"
    },
    {
        "id": 6,
        "cut": "Straight",
        "size": "XXXL"
    },
    {
        "id": 11,
        "cut": "Tailored",
        "size": "XS"
    },
    {
        "id": 12,
        "cut": "Tailored",
        "size": "S"
    },
    {
        "id": 13,
        "cut": "Tailored",
        "size": "M"
    },
    {
        "id": 14,
        "cut": "Tailored",
        "size": "L"
    },
    {
        "id": 15,
        "cut": "Tailored",
        "size": "XL"
    },
    {
        "id": 16,
        "cut": "Tailored",
        "size": "XXL"
    },
    {
        "id": 17,
        "cut": "Tailored",
        "size": "XXXL"
    }
]
```

### HTTP Request
`GET api/v1/shirt`


<!-- END_eb45f6491172f73ce8b9bab81dc33af2 -->

<!-- START_de3557d85f75096c1b6b8ecf3db1f215 -->
## Get all degrees

> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/degree" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/degree"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "Bachelor"
    },
    {
        "id": 2,
        "name": "Master"
    },
    {
        "id": 3,
        "name": "PhD - 1st year"
    },
    {
        "id": 4,
        "name": "PhD - 2nd year"
    },
    {
        "id": 5,
        "name": "PhD - 3rd year"
    },
    {
        "id": 6,
        "name": "PhD - 4th year"
    },
    {
        "id": 7,
        "name": "PhD - >5 years"
    },
    {
        "id": 8,
        "name": "other"
    }
]
```

### HTTP Request
`GET api/v1/degree`


<!-- END_de3557d85f75096c1b6b8ecf3db1f215 -->

<!-- START_1679487bc160b7e206461ed929d8f8f0 -->
## Get all countries

> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/country" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/country"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "Afghanistan"
    },
    {
        "id": 2,
        "name": "Aland Islands"
    },
    {
        "id": 3,
        "name": "Albania"
    },
    {
        "id": 4,
        "name": "Algeria"
    },
    {
        "id": 5,
        "name": "American Samoa"
    },
    {
        "id": 6,
        "name": "Andorra"
    },
    {
        "id": 7,
        "name": "Angola"
    },
    {
        "id": 8,
        "name": "Anguilla"
    },
    {
        "id": 9,
        "name": "Antarctica"
    },
    {
        "id": 10,
        "name": "Antigua And Barbuda"
    },
    {
        "id": 11,
        "name": "Argentina"
    },
    {
        "id": 12,
        "name": "Armenia"
    },
    {
        "id": 13,
        "name": "Aruba"
    },
    {
        "id": 14,
        "name": "Australia"
    },
    {
        "id": 15,
        "name": "Austria"
    },
    {
        "id": 16,
        "name": "Azerbaijan"
    },
    {
        "id": 17,
        "name": "Bahamas The"
    },
    {
        "id": 18,
        "name": "Bahrain"
    },
    {
        "id": 19,
        "name": "Bangladesh"
    },
    {
        "id": 20,
        "name": "Barbados"
    },
    {
        "id": 21,
        "name": "Belarus"
    },
    {
        "id": 22,
        "name": "Belgium"
    },
    {
        "id": 23,
        "name": "Belize"
    },
    {
        "id": 24,
        "name": "Benin"
    },
    {
        "id": 25,
        "name": "Bermuda"
    },
    {
        "id": 26,
        "name": "Bhutan"
    },
    {
        "id": 27,
        "name": "Bolivia"
    },
    {
        "id": 28,
        "name": "Bosnia and Herzegovina"
    },
    {
        "id": 29,
        "name": "Botswana"
    },
    {
        "id": 30,
        "name": "Bouvet Island"
    },
    {
        "id": 31,
        "name": "Brazil"
    },
    {
        "id": 32,
        "name": "British Indian Ocean Territory"
    },
    {
        "id": 33,
        "name": "Brunei"
    },
    {
        "id": 34,
        "name": "Bulgaria"
    },
    {
        "id": 35,
        "name": "Burkina Faso"
    },
    {
        "id": 36,
        "name": "Burundi"
    },
    {
        "id": 37,
        "name": "Cambodia"
    },
    {
        "id": 38,
        "name": "Cameroon"
    },
    {
        "id": 39,
        "name": "Canada"
    },
    {
        "id": 40,
        "name": "Cape Verde"
    },
    {
        "id": 41,
        "name": "Cayman Islands"
    },
    {
        "id": 42,
        "name": "Central African Republic"
    },
    {
        "id": 43,
        "name": "Chad"
    },
    {
        "id": 44,
        "name": "Chile"
    },
    {
        "id": 45,
        "name": "China"
    },
    {
        "id": 46,
        "name": "Christmas Island"
    },
    {
        "id": 47,
        "name": "Cocos (Keeling) Islands"
    },
    {
        "id": 48,
        "name": "Colombia"
    },
    {
        "id": 49,
        "name": "Comoros"
    },
    {
        "id": 50,
        "name": "Congo"
    },
    {
        "id": 51,
        "name": "Congo The Democratic Republic Of The"
    },
    {
        "id": 52,
        "name": "Cook Islands"
    },
    {
        "id": 53,
        "name": "Costa Rica"
    },
    {
        "id": 54,
        "name": "Cote D'Ivoire (Ivory Coast)"
    },
    {
        "id": 55,
        "name": "Croatia (Hrvatska)"
    },
    {
        "id": 56,
        "name": "Cuba"
    },
    {
        "id": 57,
        "name": "Cyprus"
    },
    {
        "id": 58,
        "name": "Czech Republic"
    },
    {
        "id": 59,
        "name": "Denmark"
    },
    {
        "id": 60,
        "name": "Djibouti"
    },
    {
        "id": 61,
        "name": "Dominica"
    },
    {
        "id": 62,
        "name": "Dominican Republic"
    },
    {
        "id": 63,
        "name": "East Timor"
    },
    {
        "id": 64,
        "name": "Ecuador"
    },
    {
        "id": 65,
        "name": "Egypt"
    },
    {
        "id": 66,
        "name": "El Salvador"
    },
    {
        "id": 67,
        "name": "Equatorial Guinea"
    },
    {
        "id": 68,
        "name": "Eritrea"
    },
    {
        "id": 69,
        "name": "Estonia"
    },
    {
        "id": 70,
        "name": "Ethiopia"
    },
    {
        "id": 71,
        "name": "Falkland Islands"
    },
    {
        "id": 72,
        "name": "Faroe Islands"
    },
    {
        "id": 73,
        "name": "Fiji Islands"
    },
    {
        "id": 74,
        "name": "Finland"
    },
    {
        "id": 75,
        "name": "France"
    },
    {
        "id": 76,
        "name": "French Guiana"
    },
    {
        "id": 77,
        "name": "French Polynesia"
    },
    {
        "id": 78,
        "name": "French Southern Territories"
    },
    {
        "id": 79,
        "name": "Gabon"
    },
    {
        "id": 80,
        "name": "Gambia The"
    },
    {
        "id": 81,
        "name": "Georgia"
    },
    {
        "id": 82,
        "name": "Germany"
    },
    {
        "id": 83,
        "name": "Ghana"
    },
    {
        "id": 84,
        "name": "Gibraltar"
    },
    {
        "id": 85,
        "name": "Greece"
    },
    {
        "id": 86,
        "name": "Greenland"
    },
    {
        "id": 87,
        "name": "Grenada"
    },
    {
        "id": 88,
        "name": "Guadeloupe"
    },
    {
        "id": 89,
        "name": "Guam"
    },
    {
        "id": 90,
        "name": "Guatemala"
    },
    {
        "id": 91,
        "name": "Guernsey and Alderney"
    },
    {
        "id": 92,
        "name": "Guinea"
    },
    {
        "id": 93,
        "name": "Guinea-Bissau"
    },
    {
        "id": 94,
        "name": "Guyana"
    },
    {
        "id": 95,
        "name": "Haiti"
    },
    {
        "id": 96,
        "name": "Heard and McDonald Islands"
    },
    {
        "id": 97,
        "name": "Honduras"
    },
    {
        "id": 98,
        "name": "Hong Kong S.A.R."
    },
    {
        "id": 99,
        "name": "Hungary"
    },
    {
        "id": 100,
        "name": "Iceland"
    },
    {
        "id": 101,
        "name": "India"
    },
    {
        "id": 102,
        "name": "Indonesia"
    },
    {
        "id": 103,
        "name": "Iran"
    },
    {
        "id": 104,
        "name": "Iraq"
    },
    {
        "id": 105,
        "name": "Ireland"
    },
    {
        "id": 106,
        "name": "Israel"
    },
    {
        "id": 107,
        "name": "Italy"
    },
    {
        "id": 108,
        "name": "Jamaica"
    },
    {
        "id": 109,
        "name": "Japan"
    },
    {
        "id": 110,
        "name": "Jersey"
    },
    {
        "id": 111,
        "name": "Jordan"
    },
    {
        "id": 112,
        "name": "Kazakhstan"
    },
    {
        "id": 113,
        "name": "Kenya"
    },
    {
        "id": 114,
        "name": "Kiribati"
    },
    {
        "id": 115,
        "name": "Korea North"
    },
    {
        "id": 116,
        "name": "Korea South"
    },
    {
        "id": 117,
        "name": "Kuwait"
    },
    {
        "id": 118,
        "name": "Kyrgyzstan"
    },
    {
        "id": 119,
        "name": "Laos"
    },
    {
        "id": 120,
        "name": "Latvia"
    },
    {
        "id": 121,
        "name": "Lebanon"
    },
    {
        "id": 122,
        "name": "Lesotho"
    },
    {
        "id": 123,
        "name": "Liberia"
    },
    {
        "id": 124,
        "name": "Libya"
    },
    {
        "id": 125,
        "name": "Liechtenstein"
    },
    {
        "id": 126,
        "name": "Lithuania"
    },
    {
        "id": 127,
        "name": "Luxembourg"
    },
    {
        "id": 128,
        "name": "Macau S.A.R."
    },
    {
        "id": 129,
        "name": "Macedonia"
    },
    {
        "id": 130,
        "name": "Madagascar"
    },
    {
        "id": 131,
        "name": "Malawi"
    },
    {
        "id": 132,
        "name": "Malaysia"
    },
    {
        "id": 133,
        "name": "Maldives"
    },
    {
        "id": 134,
        "name": "Mali"
    },
    {
        "id": 135,
        "name": "Malta"
    },
    {
        "id": 136,
        "name": "Man (Isle of)"
    },
    {
        "id": 137,
        "name": "Marshall Islands"
    },
    {
        "id": 138,
        "name": "Martinique"
    },
    {
        "id": 139,
        "name": "Mauritania"
    },
    {
        "id": 140,
        "name": "Mauritius"
    },
    {
        "id": 141,
        "name": "Mayotte"
    },
    {
        "id": 142,
        "name": "Mexico"
    },
    {
        "id": 143,
        "name": "Micronesia"
    },
    {
        "id": 144,
        "name": "Moldova"
    },
    {
        "id": 145,
        "name": "Monaco"
    },
    {
        "id": 146,
        "name": "Mongolia"
    },
    {
        "id": 147,
        "name": "Montenegro"
    },
    {
        "id": 148,
        "name": "Montserrat"
    },
    {
        "id": 149,
        "name": "Morocco"
    },
    {
        "id": 150,
        "name": "Mozambique"
    },
    {
        "id": 151,
        "name": "Myanmar"
    },
    {
        "id": 152,
        "name": "Namibia"
    },
    {
        "id": 153,
        "name": "Nauru"
    },
    {
        "id": 154,
        "name": "Nepal"
    },
    {
        "id": 155,
        "name": "Netherlands Antilles"
    },
    {
        "id": 156,
        "name": "Netherlands The"
    },
    {
        "id": 157,
        "name": "New Caledonia"
    },
    {
        "id": 158,
        "name": "New Zealand"
    },
    {
        "id": 159,
        "name": "Nicaragua"
    },
    {
        "id": 160,
        "name": "Niger"
    },
    {
        "id": 161,
        "name": "Nigeria"
    },
    {
        "id": 162,
        "name": "Niue"
    },
    {
        "id": 163,
        "name": "Norfolk Island"
    },
    {
        "id": 164,
        "name": "Northern Mariana Islands"
    },
    {
        "id": 165,
        "name": "Norway"
    },
    {
        "id": 166,
        "name": "Oman"
    },
    {
        "id": 167,
        "name": "Pakistan"
    },
    {
        "id": 168,
        "name": "Palau"
    },
    {
        "id": 169,
        "name": "Palestinian Territory Occupied"
    },
    {
        "id": 170,
        "name": "Panama"
    },
    {
        "id": 171,
        "name": "Papua new Guinea"
    },
    {
        "id": 172,
        "name": "Paraguay"
    },
    {
        "id": 173,
        "name": "Peru"
    },
    {
        "id": 174,
        "name": "Philippines"
    },
    {
        "id": 175,
        "name": "Pitcairn Island"
    },
    {
        "id": 176,
        "name": "Poland"
    },
    {
        "id": 177,
        "name": "Portugal"
    },
    {
        "id": 178,
        "name": "Puerto Rico"
    },
    {
        "id": 179,
        "name": "Qatar"
    },
    {
        "id": 180,
        "name": "Reunion"
    },
    {
        "id": 181,
        "name": "Romania"
    },
    {
        "id": 182,
        "name": "Russia"
    },
    {
        "id": 183,
        "name": "Rwanda"
    },
    {
        "id": 184,
        "name": "Saint Helena"
    },
    {
        "id": 185,
        "name": "Saint Kitts And Nevis"
    },
    {
        "id": 186,
        "name": "Saint Lucia"
    },
    {
        "id": 187,
        "name": "Saint Pierre and Miquelon"
    },
    {
        "id": 188,
        "name": "Saint Vincent And The Grenadines"
    },
    {
        "id": 189,
        "name": "Saint-Barthelemy"
    },
    {
        "id": 190,
        "name": "Saint-Martin (French part)"
    },
    {
        "id": 191,
        "name": "Samoa"
    },
    {
        "id": 192,
        "name": "San Marino"
    },
    {
        "id": 193,
        "name": "Sao Tome and Principe"
    },
    {
        "id": 194,
        "name": "Saudi Arabia"
    },
    {
        "id": 195,
        "name": "Senegal"
    },
    {
        "id": 196,
        "name": "Serbia"
    },
    {
        "id": 197,
        "name": "Seychelles"
    },
    {
        "id": 198,
        "name": "Sierra Leone"
    },
    {
        "id": 199,
        "name": "Singapore"
    },
    {
        "id": 200,
        "name": "Slovakia"
    },
    {
        "id": 201,
        "name": "Slovenia"
    },
    {
        "id": 202,
        "name": "Solomon Islands"
    },
    {
        "id": 203,
        "name": "Somalia"
    },
    {
        "id": 204,
        "name": "South Africa"
    },
    {
        "id": 205,
        "name": "South Georgia"
    },
    {
        "id": 206,
        "name": "South Sudan"
    },
    {
        "id": 207,
        "name": "Spain"
    },
    {
        "id": 208,
        "name": "Sri Lanka"
    },
    {
        "id": 209,
        "name": "Sudan"
    },
    {
        "id": 210,
        "name": "Suriname"
    },
    {
        "id": 211,
        "name": "Svalbard And Jan Mayen Islands"
    },
    {
        "id": 212,
        "name": "Swaziland"
    },
    {
        "id": 213,
        "name": "Sweden"
    },
    {
        "id": 214,
        "name": "Switzerland"
    },
    {
        "id": 215,
        "name": "Syria"
    },
    {
        "id": 216,
        "name": "Taiwan"
    },
    {
        "id": 217,
        "name": "Tajikistan"
    },
    {
        "id": 218,
        "name": "Tanzania"
    },
    {
        "id": 219,
        "name": "Thailand"
    },
    {
        "id": 220,
        "name": "Togo"
    },
    {
        "id": 221,
        "name": "Tokelau"
    },
    {
        "id": 222,
        "name": "Tonga"
    },
    {
        "id": 223,
        "name": "Trinidad And Tobago"
    },
    {
        "id": 224,
        "name": "Tunisia"
    },
    {
        "id": 225,
        "name": "Turkey"
    },
    {
        "id": 226,
        "name": "Turkmenistan"
    },
    {
        "id": 227,
        "name": "Turks And Caicos Islands"
    },
    {
        "id": 228,
        "name": "Tuvalu"
    },
    {
        "id": 229,
        "name": "Uganda"
    },
    {
        "id": 230,
        "name": "Ukraine"
    },
    {
        "id": 231,
        "name": "United Arab Emirates"
    },
    {
        "id": 232,
        "name": "United Kingdom"
    },
    {
        "id": 233,
        "name": "United States"
    },
    {
        "id": 234,
        "name": "United States Minor Outlying Islands"
    },
    {
        "id": 235,
        "name": "Uruguay"
    },
    {
        "id": 236,
        "name": "Uzbekistan"
    },
    {
        "id": 237,
        "name": "Vanuatu"
    },
    {
        "id": 238,
        "name": "Vatican City State (Holy See)"
    },
    {
        "id": 239,
        "name": "Venezuela"
    },
    {
        "id": 240,
        "name": "Vietnam"
    },
    {
        "id": 241,
        "name": "Virgin Islands (British)"
    },
    {
        "id": 242,
        "name": "Virgin Islands (US)"
    },
    {
        "id": 243,
        "name": "Wallis And Futuna Islands"
    },
    {
        "id": 244,
        "name": "Western Sahara"
    },
    {
        "id": 245,
        "name": "Yemen"
    },
    {
        "id": 246,
        "name": "Zambia"
    },
    {
        "id": 247,
        "name": "Zimbabwe"
    }
]
```

### HTTP Request
`GET api/v1/country`


<!-- END_1679487bc160b7e206461ed929d8f8f0 -->

<!-- START_e35db8e545c70086574b63263307a7fa -->
## Get all locations for a country by city name

> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/country/82/city/Aachen" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/country/82/city/Aachen"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "city": {
            "id": 12850,
            "name": "Aachen"
        },
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1268,
            "name": "Nordrhein-Westfalen"
        }
    }
]
```

### HTTP Request
`GET api/v1/country/{country}/city/{pattern?}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `country` |  required  | The country the city is in
    `pattern` |  optional  | The name of the city

<!-- END_e35db8e545c70086574b63263307a7fa -->

<!-- START_6263ef6cb594649013166ca3335c39ca -->
## Get all universities matching a pattern

> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/university/name/Aachen" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/university/name/Aachen"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1388,
        "name": "Fachhochschule Aachen",
        "url": "http:\/\/www.fh-aachen.de\/"
    },
    {
        "id": 4044,
        "name": "Rheinisch Westfälische Technische Hochschule Aachen",
        "url": "http:\/\/www.rwth-aachen.de\/"
    }
]
```

### HTTP Request
`GET api/v1/university/name/{pattern?}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `pattern` |  optional  | The pattern to match

<!-- END_6263ef6cb594649013166ca3335c39ca -->

<!-- START_7d3e0c818d37ab4c8daa837611173834 -->
## Get all languages matching a pattern

> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/language/name/Ger" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/language/name/Ger"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 23,
        "name": "German",
        "code": "de"
    }
]
```

### HTTP Request
`GET api/v1/language/name/{pattern?}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `pattern` |  optional  | string The pattern to match

<!-- END_7d3e0c818d37ab4c8daa837611173834 -->

<!-- START_e35103caa1f21125175c80eb8a96cc65 -->
## Get CHISV version info

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/version" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/version"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "branch": "dev",
    "commit": "7eb66fd398b7cf361fb688cddc5af60ed5820636",
    "tag": null
}
```

### HTTP Request
`GET api/v1/version`


<!-- END_e35103caa1f21125175c80eb8a96cc65 -->

<!-- START_e7e28d5abb6f2e2aebbd819249e3df74 -->
## Get all roles

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/role" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/role"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "admin",
        "description": "Can do anything"
    },
    {
        "id": 2,
        "name": "chair",
        "description": "Can manage conference details, tasks and assignments"
    },
    {
        "id": 3,
        "name": "captain",
        "description": "Can manage tasks and assignments"
    },
    {
        "id": 10,
        "name": "sv",
        "description": "Is associated for conferences as SV"
    }
]
```

### HTTP Request
`GET api/v1/role`


<!-- END_e7e28d5abb6f2e2aebbd819249e3df74 -->

<!-- START_0732eddb955a8a3d8ab42725aabda922 -->
## Get all states

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/state" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/state"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "planning",
        "for": "App\\Conference",
        "description": "The conference is invisible to students (only open for administrative purposes)"
    },
    {
        "id": 2,
        "name": "enrollment",
        "for": "App\\Conference",
        "description": "Students can enroll in the conference"
    },
    {
        "id": 3,
        "name": "registration",
        "for": "App\\Conference",
        "description": "The lottery was run and we are waiting for student registrations"
    },
    {
        "id": 4,
        "name": "running",
        "for": "App\\Conference",
        "description": "The conference is running"
    },
    {
        "id": 5,
        "name": "over",
        "for": "App\\Conference",
        "description": "The conference is over"
    },
    {
        "id": 11,
        "name": "enrolled",
        "for": "App\\User",
        "description": "Waiting to be accepted, waitlisted or dropped"
    },
    {
        "id": 12,
        "name": "accepted",
        "for": "App\\User",
        "description": "Accepted to the conference as SV"
    },
    {
        "id": 13,
        "name": "waitlisted",
        "for": "App\\User",
        "description": "Waiting to be accepted when other SVs cancel"
    },
    {
        "id": 14,
        "name": "dropped",
        "for": "App\\User",
        "description": "Dropped from the conference"
    },
    {
        "id": 21,
        "name": "planned",
        "for": "App\\Job",
        "description": "The job is planned to be run in the future"
    },
    {
        "id": 22,
        "name": "processing",
        "for": "App\\Job",
        "description": "The job is currently running"
    },
    {
        "id": 23,
        "name": "successful",
        "for": "App\\Job",
        "description": "The job finished successfully"
    },
    {
        "id": 24,
        "name": "failed",
        "for": "App\\Job",
        "description": "The job stopped and failed"
    },
    {
        "id": 25,
        "name": "softfail",
        "for": "App\\Job",
        "description": "The job encountered an error and will restart shortly"
    },
    {
        "id": 31,
        "name": "placed",
        "for": "App\\Bid",
        "description": "The bid is waiting for the auction"
    },
    {
        "id": 32,
        "name": "successful",
        "for": "App\\Bid",
        "description": "The bid won the auction creating an assignment"
    },
    {
        "id": 33,
        "name": "unsuccessful",
        "for": "App\\Bid",
        "description": "The bid did not win the auction (all slots filled)"
    },
    {
        "id": 34,
        "name": "conflict",
        "for": "App\\Bid",
        "description": "The bid is invalid due to a task time conflict"
    },
    {
        "id": 35,
        "name": "unavailable",
        "for": "App\\Bid",
        "description": "The bid expresses unavailability, thus blocked assignment"
    },
    {
        "id": 41,
        "name": "assigned",
        "for": "App\\Assignment",
        "description": "The task is assigned but yet not being worked on"
    },
    {
        "id": 42,
        "name": "checked-in",
        "for": "App\\Assignment",
        "description": "SV is working on the task at the moment"
    },
    {
        "id": 43,
        "name": "done",
        "for": "App\\Assignment",
        "description": "Task has been completed"
    }
]
```

### HTTP Request
`GET api/v1/state`


<!-- END_0732eddb955a8a3d8ab42725aabda922 -->

#Image


<!-- START_b10924faa610eedbd59487bb46359ef0 -->
## Create a new image

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"image":"ab","name":"Awesome image","type":"fugit","owner_id":1,"owner_type":"App\\User"}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "image": "ab",
    "name": "Awesome image",
    "type": "fugit",
    "owner_id": 1,
    "owner_type": "App\\User"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (422):

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "image": [
            "The image must be an image.",
            "The image must be a file of type: jpeg, png, jpg, gif.",
            "The image has invalid image dimensions."
        ],
        "type": [
            "The selected type is invalid."
        ]
    }
}
```

### HTTP Request
`POST api/v1/image`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `image` | binary-file |  required  | Binary image
        `name` | string |  required  | Image name
        `type` | string |  required  | Can be one of 'artwork', 'icon' or 'avatar'
        `owner_id` | integer |  required  | Reference the image to this model
        `owner_type` | string |  required  | Reference the image to this model class
    
<!-- END_b10924faa610eedbd59487bb46359ef0 -->

<!-- START_a98e5b4669ac3fa3f0c1e821129382e7 -->
## Update an image

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/image/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"image":"quos"}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/image/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "image": "quos"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Image] 1"
}
```

### HTTP Request
`PUT api/v1/image/{image}`

`PATCH api/v1/image/{image}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `image` | binary-file |  required  | Binary image
    
<!-- END_a98e5b4669ac3fa3f0c1e821129382e7 -->

<!-- START_bd133915229a369312c0c49c19e18d2c -->
## Delete an image

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/image/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/image/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": null,
    "success": true,
    "message": "Image deleted!"
}
```

### HTTP Request
`DELETE api/v1/image/{image}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `image` |  required  | The image's id

<!-- END_bd133915229a369312c0c49c19e18d2c -->

#Job


<!-- START_d6e16153e2ff68200766fc9789db9920 -->
## Get all jobs

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/job" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/job"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "total": 0,
    "take": 50
}
```

### HTTP Request
`GET api/v1/job`


<!-- END_d6e16153e2ff68200766fc9789db9920 -->

<!-- START_f0ecf6516bb0e1824e6db6d15f4731a1 -->
## Get a job

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/job/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/job/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Job] 1"
}
```

### HTTP Request
`GET api/v1/job/{job}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `job` |  required  | The job's id

<!-- END_f0ecf6516bb0e1824e6db6d15f4731a1 -->

#Note


<!-- START_a6fe630930e6174d987c43d406b17684 -->
## Create a new note

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/note" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"for_id":1,"for_type":"App\\User","text":"More than expected","conference_id":1}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/note"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "for_id": 1,
    "for_type": "App\\User",
    "text": "More than expected",
    "conference_id": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": {
        "id": 1,
        "creator_id": 1,
        "for_id": 1,
        "for_type": "App\\User",
        "text": "More than expected",
        "created_at": "2020-07-07 14:57:15",
        "updated_at": "2020-07-07 14:57:15",
        "conference_id": "1"
    },
    "message": "Note created"
}
```

### HTTP Request
`POST api/v1/note`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `for_id` | integer |  required  | Id for the note's associated object
        `for_type` | string |  required  | Class name for the note's associated object
        `text` | string |  required  | The note's content
        `conference_id` | integer |  required  | The conference to bind this note to (used for App\User)
    
<!-- END_a6fe630930e6174d987c43d406b17684 -->

<!-- START_e72a2bf06aae44bb29232368172c7ba6 -->
## Delete a note

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/note/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/note/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Note deleted"
}
```
> Example response (404):

```json
{
    "message": "No query results for model [App\\Note] 1"
}
```

### HTTP Request
`DELETE api/v1/note/{note}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `note` |  required  | The note's id

<!-- END_e72a2bf06aae44bb29232368172c7ba6 -->

#Notification


<!-- START_9810cba1aeb488235eda9984b2fca3e1 -->
## Get all notification templates

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/notification_template" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/notification_template"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "chi19 Let's get registered",
        "conference_id": "1",
        "data": "{\"destinations\":[{\"role_id\":10,\"state_id\":12,\"type\":\"group\",\"display\":\"Accepted SVs\"}],\"elements\":[{\"type\":\"markdown\",\"data\":\"As you might have noticed, the CHI 20## registration site is live. Now we can step right into the next phase of the SV program! This email contains info about:\\n\\n- The SV contract\\n- Registration info (deadline: ###### ##nd, 20##)\\n- Visa support letters\\n- Slack Channel\\n- Housing\\n\\n\\n#THE SV CONTRACT\\n\\nPlease take the time to read this carefully. We want to make sure that everybody is on the same page when they arrive in Glasgow and knows what is expected of them. Being an SV at CHI can be a wonderful experience, but it's less wonderful when you are working extra hours, because a fellow SV didn't step up and work their hours.\\n\\n##You agree to\\n\\n1. Volunteer a _minimum_ of __20 hours__ at the conference as a student volunteer.\\n\\n2. Arrive in Glasgow on or before Sunday, __May 5th__, and stay through the end of the conference on Thursday, May 9th (or Friday, May 10th, if you plan to attend the SV Party).\\n\\n3. Attend one of the three SV orientations. The orientation times are __Saturday, May 4th at 6pm__ and __Sunday, May 5th at 11am and 6pm__.\\n\\n##We agree to\\n\\n1. Waive your registration fees and give you a conference reception ticket (you must pay workshop\\\\\\\\\/course fees, if you want to attend any).\\n\\n2. Provide you with breakfast and lunch daily (food details are still being worked out).\\n\\n\\n#LET'S GET REGISTERED\\n\\nRegistration is now open! Here's the process for registering for CHI 2019 as a student volunteer. (Note: you must register for the conference by February 22nd, 2019 to maintain your SV spot. If you know that you can't attend, please let us know as soon as possible so we can give your spot to someone on the waitlist).\\n\\n1. Go to [this website](http:\/\/www.cvent.com).\\n__ATTENTION: This link can ONLY be used by accepted Student Volunteers.__\\n\\n\\n##Important additional details\\nIf we haven't heard from you in any way by February 22nd, 2018, 12:00 EST, we will assume you are no longer interested in volunteering, and will remove you from the SV accepted list.\\n\\nPlease let us know if you have any issues, we are happy to work things out with you!\\n\\n\\n#VISA SUPPORT LETTERS\\n\\nYou need to download the request form as part of the registration process and follow the instructions described in that form.\\n\\n\\n#SLACK CHANNEL\\n\\nWe will invite you to our Slack Channel as soon as you are registered for the conference. Slack is a good place for you to introduce yourselves to your fellow SVs, or to coordinate sharing a hotel room. It also provides us with a much faster channel to reach you (and vice versa) during the conference, so please accept the invitation as soon as you receive it.\\n\\n\\n## HOUSING\\nYou can find information about housing at [chi2019.acm.org\/for-attendees\/hotels](https:\/\/chi2019.acm.org\/for-attendees\/hotels\/) - the estimated rates are included below. To reduce your accommodation costs, you can share rooms with fellow SVs. You can talk to your fellow SVs via Slack and find someone to share a room with. Use the #housing channel. However, there are a couple of things that you should keep in mind before booking a hotel room together:\\n\\n##CONFERENCE HOTEL RATES\\nHere are the conference hotel rates for your reference. They are also available on the conference website. Most of these are for a single or double room.\\n\\n\\nThat's it for now - if you have any other questions: just email us and we will do our best to help you with any questions as quickly as we can.\"}],\"greeting\":null,\"subject\":\"LET'S GET REGISTERED -- DEADLINES INSIDE\",\"salutation\":\"Regards,\\n\\nSV Chairs CHI20, Honolulu, Hawai\\u02bbi, USA\\n\\n[noreply@chisv.org](mailto:noreply@chisv.org)\\n\\n[ACM](https:\/\/www.acm.org\/)\"}",
        "year": "2020",
        "created_at": null,
        "updated_at": null,
        "conference": {
            "id": 1,
            "key": "chi20"
        }
    }
]
```

### HTTP Request
`GET api/v1/notification_template`


<!-- END_9810cba1aeb488235eda9984b2fca3e1 -->

<!-- START_3437a4c594338a2408235c8bd5cea113 -->
## Create a new notification template

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/notification_template" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"name":"My New Template!","data":{"destinations":[{"type":"group","role_id":10,"state_id":12}],"elements":[{"type":"action","data":{"caption":"CHISV Website","url":"https:\/\/chisv.org"}},{"type":"markdown","data":"!See text below"}]},"year":2020,"conference_id":1}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/notification_template"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "name": "My New Template!",
    "data": {
        "destinations": [
            {
                "type": "group",
                "role_id": 10,
                "state_id": 12
            }
        ],
        "elements": [
            {
                "type": "action",
                "data": {
                    "caption": "CHISV Website",
                    "url": "https:\/\/chisv.org"
                }
            },
            {
                "type": "markdown",
                "data": "!See text below"
            }
        ]
    },
    "year": 2020,
    "conference_id": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Template created"
}
```

### HTTP Request
`POST api/v1/notification_template`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Give the template a unique name
        `data` | string |  required  | The enrollment form template in JSON encoded form
        `year` | integer |  required  | YYYY formatted year
        `conference_id` | integer |  required  | Bind to this conference
        `data.destinations` | array |  required  | Multiple destinations, see below for 3 examples
        `data.destinations[0].type` | string |  optional  | Must be 'group'
        `data.destinations[0].role_id` | integer |  optional  | Pointing to the role by id
        `data.destinations[0].state_id` | integer |  optional  | Pointing to the state by id
        `data.elements` | array |  required  | Multiple elements, see below for action and markdown below
        `data.elements[0].type` | required |  optional  | One of 'action', 'markdown'
        `data.elements[1].type` | required |  optional  | One of 'action', 'markdown'
        `data.elements[0].data.caption` | string |  optional  | Is required if type is 'action'
        `data.elements[0].data.url` | string |  optional  | Is required if type is 'action'
        `data.elements[1].data` | string |  optional  | Is required if type is 'markdown'
    
<!-- END_3437a4c594338a2408235c8bd5cea113 -->

<!-- START_9a71c195bef487ee5f5fcae091218d61 -->
## Delete a notification template

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/notification_template/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/notification_template/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Template deleted"
}
```

### HTTP Request
`DELETE api/v1/notification_template/{notification_template}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `notification_template` |  required  | The notification template's id to delete

<!-- END_9a71c195bef487ee5f5fcae091218d61 -->

<!-- START_dab1dd2c6a2e20ca5a7543c7bb923357 -->
## Get all notifications of the authenticated user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/notification" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/notification"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [],
    "clearUntil": "2020-07-07 14:57:15"
}
```

### HTTP Request
`GET api/v1/notification`


<!-- END_dab1dd2c6a2e20ca5a7543c7bb923357 -->

<!-- START_aae6a7590ad399556c68f3f43d3b8180 -->
## Get a notification

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/notification/f8f02574-a9eb-408b-9836-c7408b248afb" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/notification/f8f02574-a9eb-408b-9836-c7408b248afb"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```
> Example response (404):

```json
{
    "message": "No query results for model [Illuminate\\Notifications\\DatabaseNotification] fd8f02574-a9eb-408b-9836-c7408b248afb"
}
```

### HTTP Request
`GET api/v1/notification/{database_notification}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `database_notification` |  required  | Notification's UUID

<!-- END_aae6a7590ad399556c68f3f43d3b8180 -->

#Permission


<!-- START_7ae99daa4c685955a0bb1957dc7c7125 -->
## Create a new permission

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/permission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"user_id":1,"role_id":2,"conference_id":1,"state_id":11}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/permission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "user_id": 1,
    "role_id": 2,
    "conference_id": 1,
    "state_id": 11
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Permission granted!"
}
```
> Example response (400):

```json
{
    "message": "Permission already exists"
}
```

### HTTP Request
`POST api/v1/permission`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `user_id` | integer |  required  | The user's id
        `role_id` | integer |  required  | The role of the permission by id
        `conference_id` | integer |  optional  | The conference id to bind the permission to
        `state_id` | integer |  optional  | The permission's state
    
<!-- END_7ae99daa4c685955a0bb1957dc7c7125 -->

<!-- START_02593a89d7299e12fbe17b2a19fbeac2 -->
## Update a permission

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/permission/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"user_id":1,"role_id":2,"conference_id":1,"state_id":11}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/permission/2"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "user_id": 1,
    "role_id": 2,
    "conference_id": 1,
    "state_id": 11
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": {
        "id": 2,
        "user_id": 2,
        "conference_id": 1,
        "created_at": "2020-07-07 14:53:12",
        "updated_at": "2020-07-07 14:57:15",
        "enrollment_form_id": 3,
        "lottery_position": null,
        "conference": {
            "id": 1,
            "name": "CHI 2020",
            "key": "chi20",
            "location": "Honolulu, Hawaiʻi, USA",
            "timezone_id": 366,
            "start_date": "2020-07-04",
            "end_date": "2020-07-10",
            "description": "##Aloha!\n\nThe ACM CHI Conference on Human Factors in Computing Systems is the premier international conference of Human-Computer Interaction. __CHI__ – pronounced ‘kai’ – is a place where researchers and practitioners gather from across the world to discuss the latest in interactive technology. We are a multicultural community from highly diverse backgrounds who together investigate and design new and creative ways for people to interact using technology.\n\n###From April 25th to 30th\nCHI will, for the first time, take place in beautiful __Honolulu__, on the island of Oahu, Hawaiʻi, USA. Mahalo! Regina Bernhaupt and Florian ‘Floyd’ Mueller CHI 2020 General Chairs [generalchairs@chi2020.acm.org](mailto:generalchairs@chi2020.acm.org)",
            "enrollment_form_id": 1,
            "state_id": 4,
            "url": "https:\/\/www.acm.org\/",
            "url_name": "ACM",
            "created_at": "2020-07-07 14:53:10",
            "updated_at": "2020-07-07 14:53:10",
            "volunteer_hours": 20,
            "volunteer_max": 100,
            "email_chair": "noreply@chisv.org",
            "bidding_start": "2020-07-07 14:53:10",
            "bidding_end": "2020-07-10 00:00:00",
            "bidding_enabled": true
        }
    },
    "message": "Permission updated!"
}
```

### HTTP Request
`PUT api/v1/permission/{permission}`

`PATCH api/v1/permission/{permission}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `permission` |  required  | The permission's id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `user_id` | integer |  required  | The user's id
        `role_id` | integer |  required  | The role of the permission by id
        `conference_id` | integer |  optional  | The conference id to bind the permission to
        `state_id` | integer |  optional  | The permission's state
    
<!-- END_02593a89d7299e12fbe17b2a19fbeac2 -->

<!-- START_44ad155ad0de0418e9d1794951e82dfc -->
## Delete a new permission

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/permission/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/permission/2"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "Permission revoked"
}
```
> Example response (404):

```json
{
    "message": "No query results for model [App\\Permission] 1"
}
```

### HTTP Request
`DELETE api/v1/permission/{permission}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `permission` |  required  | The permission's id

<!-- END_44ad155ad0de0418e9d1794951e82dfc -->

#Report


<!-- START_e367f5d326b0f2aa81935f2faf023e9d -->
## Get a report by name
The result will contain all important columns and pagination hint. Available reports are:
&#039;sv_doubles&#039;,
&#039;sv_accepted_minutes_ago&#039;,
&#039;sv_shirts&#039;,
&#039;sv_hours&#039;,
&#039;sv_bids&#039;,
&#039;sv_detail&#039;,
&#039;sv_demographics_country&#039;,
&#039;sv_demographics_language&#039;,
&#039;task_overview&#039;,
&#039;tasks_free_slots&#039;,
&#039;tasks_table_dump&#039;

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/conference/chi20/report/sv_hours" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/conference/chi20/report/sv_hours"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "columns": [
        {
            "field": "firstname",
            "label": "Firstname",
            "width": null,
            "numeric": false,
            "sortable": true,
            "searchable": true
        },
        {
            "field": "lastname",
            "label": "Lastname",
            "width": null,
            "numeric": false,
            "sortable": true,
            "searchable": true
        },
        {
            "field": "hours_done",
            "label": "Hours Done",
            "width": null,
            "numeric": true,
            "sortable": true,
            "searchable": false
        },
        {
            "field": "assignments_count",
            "label": "Assignments",
            "width": null,
            "numeric": true,
            "sortable": true,
            "searchable": false
        }
    ],
    "data": [
        {
            "user_id": 1,
            "firstname": "Milton",
            "lastname": "Waddams",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 2,
            "firstname": "Dortha",
            "lastname": "Waters",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 3,
            "firstname": "Jevon",
            "lastname": "Ortiz",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 4,
            "firstname": "Noelia",
            "lastname": "Kassulke",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 5,
            "firstname": "Elva",
            "lastname": "Gaylord",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 6,
            "firstname": "Hosea",
            "lastname": "Macejkovic",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 7,
            "firstname": "Remington",
            "lastname": "Volkman",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 8,
            "firstname": "Hollis",
            "lastname": "Haag",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 9,
            "firstname": "Claire",
            "lastname": "Beier",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 10,
            "firstname": "Pauline",
            "lastname": "Effertz",
            "hours_done": 0,
            "assignments_count": 0
        },
        {
            "user_id": 11,
            "firstname": "Ayla",
            "lastname": "Bergnaum",
            "hours_done": 0,
            "assignments_count": 0
        }
    ],
    "updated": "2020-07-07T14:57:09.612340Z",
    "paginate": true
}
```

### HTTP Request
`GET api/v1/conference/{conference}/report/{name}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `conference` |  required  | The conference's key
    `name` |  required  | The reports key

<!-- END_e367f5d326b0f2aa81935f2faf023e9d -->

#Task


<!-- START_e56949261df93656a185127400a20c95 -->
## Create a new task

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/task" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"conference_id":1,"name":"SVing Task","location":"Main Hall","description":"Nothing to do here","date":"2020-07-01","start_at":"12:00:00","end_at":"15:00:00","hours":3,"priority":2,"slots":5}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/task"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "conference_id": 1,
    "name": "SVing Task",
    "location": "Main Hall",
    "description": "Nothing to do here",
    "date": "2020-07-01",
    "start_at": "12:00:00",
    "end_at": "15:00:00",
    "hours": 3,
    "priority": 2,
    "slots": 5
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "id": 501,
    "conference_id": "1",
    "name": "SVing Task",
    "description": "Nothing to do here",
    "location": "Main Hall",
    "date": "2020-07-01 00:00:00",
    "start_at": "12:00:00",
    "end_at": "15:00:00",
    "priority": 2,
    "slots": 5,
    "hours": 3
}
```

### HTTP Request
`POST api/v1/task`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `conference_id` | integer |  required  | Create task for this conference by id
        `name` | string |  required  | Task's name
        `location` | string |  required  | Task's location
        `description` | string |  required  | Task's description
        `date` | string |  required  | Task's date
        `start_at` | string |  required  | Task's start time
        `end_at` | string |  required  | Task's end time
        `hours` | integer |  required  | Task's accounted hours
        `priority` | integer |  required  | Task's priority
        `slots` | integer |  required  | Max allowed SVs
    
<!-- END_e56949261df93656a185127400a20c95 -->

<!-- START_8c6e980f4862789e22b0446062343f9c -->
## Update a task

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/task/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"conference_id":1,"name":"SVing Task","location":"Main Hall","description":"Nothing to do here","date":"2020-07-01","start_at":"12:00:00","end_at":"15:00:00","hours":3,"priority":2,"slots":5}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/task/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "conference_id": 1,
    "name": "SVing Task",
    "location": "Main Hall",
    "description": "Nothing to do here",
    "date": "2020-07-01",
    "start_at": "12:00:00",
    "end_at": "15:00:00",
    "hours": 3,
    "priority": 2,
    "slots": 5
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 1,
    "conference_id": "1",
    "name": "SVing Task",
    "description": "Nothing to do here",
    "location": "Main Hall",
    "date": "2020-07-01 00:00:00",
    "start_at": "12:00:00",
    "end_at": "15:00:00",
    "priority": 2,
    "slots": 5,
    "hours": 3
}
```

### HTTP Request
`PUT api/v1/task/{task}`

`PATCH api/v1/task/{task}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `task` |  required  | Task's id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `conference_id` | integer |  required  | Bound to this conference by id
        `name` | string |  required  | Task's name
        `location` | string |  required  | Task's location
        `description` | string |  required  | Task's description
        `date` | string |  required  | Task's date
        `start_at` | string |  required  | Task's start time
        `end_at` | string |  required  | Task's end time
        `hours` | integer |  required  | Task's accounted hours
        `priority` | integer |  required  | Task's priority
        `slots` | integer |  required  | Max allowed SVs
    
<!-- END_8c6e980f4862789e22b0446062343f9c -->

<!-- START_3e2ac028a2ca35997032bf708b18c0c2 -->
## Delete a task

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/task/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/task/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Task removed. 5\/0\/0 associated bids\/assignments\/notes have been deleted."
}
```

### HTTP Request
`DELETE api/v1/task/{task}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `task` |  required  | Task's id

<!-- END_3e2ac028a2ca35997032bf708b18c0c2 -->

#User


<!-- START_8ae5d428da27b2b014dc767c2f19a813 -->
## Create a new user

> Example request:

```bash
curl -X POST \
    "https://chisv.org/api/v1/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"firstname":"Jacob","lastname":"Smith","email":"jacob@example.com","languages":[{"id":23}],"location":{"country":{"id":82,"name":"Germany"},"region":{"id":1268,"name":"Nordrhein-Westfalen"},"city":{"id":12850,"name":"Aachen"}},"university":{"id":4044,"name":"RWTH Aachen"},"degree_id":2,"shirt_id":3,"locale_id":51,"past_conferences":["CHI 2019"],"past_conferences_sv":["CHI 2019"],"password":"secret","password_confirmation":"secret"}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "firstname": "Jacob",
    "lastname": "Smith",
    "email": "jacob@example.com",
    "languages": [
        {
            "id": 23
        }
    ],
    "location": {
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1268,
            "name": "Nordrhein-Westfalen"
        },
        "city": {
            "id": 12850,
            "name": "Aachen"
        }
    },
    "university": {
        "id": 4044,
        "name": "RWTH Aachen"
    },
    "degree_id": 2,
    "shirt_id": 3,
    "locale_id": 51,
    "past_conferences": [
        "CHI 2019"
    ],
    "past_conferences_sv": [
        "CHI 2019"
    ],
    "password": "secret",
    "password_confirmation": "secret"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": {
        "firstname": "Jacob",
        "lastname": "Smith",
        "email": "jacob@example.com",
        "locale_id": 51,
        "degree_id": 2,
        "shirt_id": 3,
        "past_conferences": [
            "CHI 2019"
        ],
        "past_conferences_sv": [
            "CHI 2019"
        ],
        "country_id": 82,
        "region_id": 1268,
        "city_id": 12850,
        "university_id": 4044,
        "updated_at": "2020-07-07 14:57:09",
        "created_at": "2020-07-07 14:57:09",
        "id": 12
    },
    "error": null
}
```

### HTTP Request
`POST api/v1/register`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `firstname` | string |  required  | The user's first name
        `lastname` | string |  required  | The user's last name
        `email` | string |  required  | The user's email
        `languages` | array&lt;[Language](#get-all-languages-matching-a-pattern)&gt; |  optional  | An array of languages
        `languages.*.id` | integer |  required  | A [language's](#get-all-languages-matching-a-pattern) id
        `location` | [Location](#get-all-locations-for-a-country-by-city-name) |  required  | The users location by city name
        `location.country.id` | integer |  required  | The location's country id
        `location.country.name` | string |  optional  | The location's country name
        `location.region.id` | integer |  optional  | The location's region id
        `location.region.name` | string |  optional  | The location's region name
        `location.city.id` | integer |  optional  | The location's city id
        `location.city.name` | string |  optional  | The location's city name
        `university.id` | integer |  optional  | The [university's](#get-all-universities-matching-a-pattern) id
        `university.name` | string |  optional  | The fallback university's name if no id used (see above)
        `degree_id` | integer |  required  | The user's [degree](#get-all-degrees)
        `shirt_id` | integer |  required  | The user's [shirt](#get-all-t-shirts)
        `locale_id` | integer |  required  | The user's [locale](#get-all-locales)
        `past_conferences` | array&lt;string&gt; |  optional  | The user's past attended conferences as array
        `past_conferences.*` | string |  optional  | A user's past attended conference
        `past_conferences_sv` | array&lt;string&gt; |  optional  | The user's past attended conferences as SV as array
        `past_conferences_sv.*` | string |  optional  | A user's past attended conference as SV
        `password` | string |  optional  | The user's password
        `password_confirmation` | string |  optional  | The user's password
    
<!-- END_8ae5d428da27b2b014dc767c2f19a813 -->

<!-- START_3b01a55d7c160fc3bce9f7104ed40bc5 -->
## Get the authenticated user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/user/self" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/user/self"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 1,
    "firstname": "Milton",
    "lastname": "Waddams",
    "past_conferences": null,
    "past_conferences_sv": null,
    "permissions": [
        {
            "id": 1,
            "role": {
                "id": 10,
                "name": "sv",
                "description": "Is associated for conferences as SV"
            },
            "state": {
                "id": 12,
                "name": "accepted",
                "description": "Accepted to the conference as SV"
            },
            "enrollment_form": {
                "id": 2,
                "name": "Default",
                "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":true,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":14,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":26,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":false,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"Error sint qui vel ipsam. Sequi optio rerum et praesentium asperiores sequi non. Et voluptatem est odit totam voluptatem culpa accusantium.\",\"required\":true}}}"
            },
            "conference": {
                "id": 1,
                "key": "chi20"
            }
        },
        {
            "id": 12,
            "role": {
                "id": 1,
                "name": "admin",
                "description": "Can do anything"
            },
            "state": null,
            "enrollment_form": null,
            "conference": null
        }
    ],
    "locale": {
        "id": 40,
        "code": "en",
        "name": "English (United States)"
    },
    "avatar": null
}
```

### HTTP Request
`GET api/v1/user/self`


<!-- END_3b01a55d7c160fc3bce9f7104ed40bc5 -->

<!-- START_621dcdc4770a45b8129b12966db31c4d -->
## Get all bids for a user of a given conference

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/user/1/bid/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/user/1/bid/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 1,
        "task_id": 4,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 4,
            "name": "Metal Molding Operator",
            "start_at": "17:30:00",
            "end_at": "18:30:00",
            "hours": 1,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 2,
        "task_id": 6,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 6,
            "name": "Animal Control Worker",
            "start_at": "14:15:00",
            "end_at": "15:30:00",
            "hours": 1.25,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 3,
        "task_id": 9,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 9,
            "name": "Assessor",
            "start_at": "11:15:00",
            "end_at": "12:00:00",
            "hours": 0.75,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 4,
        "task_id": 12,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 12,
            "name": "Utility Meter Reader",
            "start_at": "17:15:00",
            "end_at": "19:00:00",
            "hours": 1.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 5,
        "task_id": 15,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 15,
            "name": "Occupational Therapist",
            "start_at": "08:45:00",
            "end_at": "09:45:00",
            "hours": 1,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 6,
        "task_id": 17,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 17,
            "name": "Assessor",
            "start_at": "08:30:00",
            "end_at": "08:45:00",
            "hours": 0.25,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 7,
        "task_id": 19,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 19,
            "name": "Cement Mason and Concrete Finisher",
            "start_at": "15:45:00",
            "end_at": "18:00:00",
            "hours": 2.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 8,
        "task_id": 20,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 20,
            "name": "Forensic Investigator",
            "start_at": "10:00:00",
            "end_at": "11:15:00",
            "hours": 1.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 9,
        "task_id": 23,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 23,
            "name": "Etcher",
            "start_at": "13:45:00",
            "end_at": "14:45:00",
            "hours": 1,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 10,
        "task_id": 28,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 28,
            "name": "Industrial-Organizational Psychologist",
            "start_at": "17:30:00",
            "end_at": "19:00:00",
            "hours": 1.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 11,
        "task_id": 33,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 33,
            "name": "University",
            "start_at": "08:45:00",
            "end_at": "10:30:00",
            "hours": 1.75,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 12,
        "task_id": 38,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 38,
            "name": "Customer Service Representative",
            "start_at": "17:00:00",
            "end_at": "17:30:00",
            "hours": 0.5,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 13,
        "task_id": 39,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 39,
            "name": "Welding Machine Operator",
            "start_at": "10:45:00",
            "end_at": "12:00:00",
            "hours": 1.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 14,
        "task_id": 43,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 43,
            "name": "Clinical Psychologist",
            "start_at": "16:15:00",
            "end_at": "17:45:00",
            "hours": 1.5,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 15,
        "task_id": 44,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 44,
            "name": "Patrol Officer",
            "start_at": "14:15:00",
            "end_at": "15:30:00",
            "hours": 1.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 16,
        "task_id": 45,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 45,
            "name": "Physical Therapist Assistant",
            "start_at": "10:00:00",
            "end_at": "10:45:00",
            "hours": 0.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 17,
        "task_id": 51,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 51,
            "name": "Pipelaying Fitter",
            "start_at": "14:15:00",
            "end_at": "15:00:00",
            "hours": 0.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 18,
        "task_id": 56,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 56,
            "name": "Wellhead Pumper",
            "start_at": "12:45:00",
            "end_at": "15:00:00",
            "hours": 2.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 19,
        "task_id": 59,
        "state_id": 31,
        "preference": 0,
        "task": {
            "id": 59,
            "name": "Heating and Air Conditioning Mechanic",
            "start_at": "08:15:00",
            "end_at": "09:00:00",
            "hours": 0.75,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 20,
        "task_id": 78,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 78,
            "name": "Credit Checker",
            "start_at": "17:15:00",
            "end_at": "18:30:00",
            "hours": 1.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 21,
        "task_id": 84,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 84,
            "name": "Forest Fire Fighter",
            "start_at": "13:00:00",
            "end_at": "14:30:00",
            "hours": 1.5,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 22,
        "task_id": 89,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 89,
            "name": "Military Officer",
            "start_at": "11:15:00",
            "end_at": "12:45:00",
            "hours": 1.5,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 23,
        "task_id": 92,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 92,
            "name": "Food Science Technician",
            "start_at": "11:00:00",
            "end_at": "12:00:00",
            "hours": 1,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 24,
        "task_id": 94,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 94,
            "name": "Buffing and Polishing Operator",
            "start_at": "17:30:00",
            "end_at": "17:45:00",
            "hours": 0.25,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 25,
        "task_id": 96,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 96,
            "name": "Office Machine and Cash Register Servicer",
            "start_at": "11:15:00",
            "end_at": "12:30:00",
            "hours": 1.25,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 26,
        "task_id": 97,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 97,
            "name": "Lathe Operator",
            "start_at": "11:15:00",
            "end_at": "13:15:00",
            "hours": 2,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 27,
        "task_id": 105,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 105,
            "name": "Artist",
            "start_at": "13:15:00",
            "end_at": "14:15:00",
            "hours": 1,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 28,
        "task_id": 107,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 107,
            "name": "Precision Lens Grinders and Polisher",
            "start_at": "17:30:00",
            "end_at": "19:45:00",
            "hours": 2.25,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 29,
        "task_id": 113,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 113,
            "name": "Radio Operator",
            "start_at": "11:15:00",
            "end_at": "13:00:00",
            "hours": 1.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 30,
        "task_id": 120,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 120,
            "name": "Irradiated-Fuel Handler",
            "start_at": "11:15:00",
            "end_at": "12:00:00",
            "hours": 0.75,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 31,
        "task_id": 124,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 124,
            "name": "Brazing Machine Operator",
            "start_at": "09:15:00",
            "end_at": "09:30:00",
            "hours": 0.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 32,
        "task_id": 126,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 126,
            "name": "Typesetter",
            "start_at": "16:00:00",
            "end_at": "17:15:00",
            "hours": 1.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 33,
        "task_id": 132,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 132,
            "name": "Home",
            "start_at": "16:00:00",
            "end_at": "16:30:00",
            "hours": 0.5,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 34,
        "task_id": 133,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 133,
            "name": "Biochemist",
            "start_at": "13:45:00",
            "end_at": "15:15:00",
            "hours": 1.5,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 35,
        "task_id": 134,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 134,
            "name": "Photographic Developer",
            "start_at": "09:15:00",
            "end_at": "10:00:00",
            "hours": 0.75,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 36,
        "task_id": 139,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 139,
            "name": "Night Shift",
            "start_at": "11:30:00",
            "end_at": "11:45:00",
            "hours": 0.25,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 37,
        "task_id": 140,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 140,
            "name": "Electrician",
            "start_at": "11:15:00",
            "end_at": "12:00:00",
            "hours": 0.75,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 38,
        "task_id": 141,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 141,
            "name": "Compliance Officers",
            "start_at": "14:45:00",
            "end_at": "17:00:00",
            "hours": 2.25,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 39,
        "task_id": 142,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 142,
            "name": "Anthropology Teacher",
            "start_at": "13:45:00",
            "end_at": "15:30:00",
            "hours": 1.75,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 40,
        "task_id": 144,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 144,
            "name": "Lifeguard",
            "start_at": "09:45:00",
            "end_at": "11:15:00",
            "hours": 1.5,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 41,
        "task_id": 149,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 149,
            "name": "Gaming Service Worker",
            "start_at": "15:45:00",
            "end_at": "17:30:00",
            "hours": 1.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 42,
        "task_id": 152,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 152,
            "name": "Electrical Power-Line Installer",
            "start_at": "12:45:00",
            "end_at": "13:15:00",
            "hours": 0.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 43,
        "task_id": 153,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 153,
            "name": "Molding and Casting Worker",
            "start_at": "17:45:00",
            "end_at": "19:45:00",
            "hours": 2,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 44,
        "task_id": 154,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 154,
            "name": "Correctional Officer",
            "start_at": "12:30:00",
            "end_at": "13:45:00",
            "hours": 1.25,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 45,
        "task_id": 157,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 157,
            "name": "Central Office",
            "start_at": "17:00:00",
            "end_at": "18:30:00",
            "hours": 1.5,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 46,
        "task_id": 165,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 165,
            "name": "Purchasing Agent",
            "start_at": "16:30:00",
            "end_at": "17:15:00",
            "hours": 0.75,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 47,
        "task_id": 166,
        "state_id": 31,
        "preference": 0,
        "task": {
            "id": 166,
            "name": "Claims Examiner",
            "start_at": "16:45:00",
            "end_at": "18:45:00",
            "hours": 2,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 48,
        "task_id": 168,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 168,
            "name": "Valve Repairer OR Regulator Repairer",
            "start_at": "14:45:00",
            "end_at": "15:30:00",
            "hours": 0.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 49,
        "task_id": 170,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 170,
            "name": "Electrical Engineering Technician",
            "start_at": "08:30:00",
            "end_at": "09:45:00",
            "hours": 1.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 50,
        "task_id": 174,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 174,
            "name": "Petroleum Technician",
            "start_at": "15:45:00",
            "end_at": "17:45:00",
            "hours": 2,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 51,
        "task_id": 175,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 175,
            "name": "Insurance Investigator",
            "start_at": "17:30:00",
            "end_at": "18:00:00",
            "hours": 0.5,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 52,
        "task_id": 179,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 179,
            "name": "Infantry Officer",
            "start_at": "12:00:00",
            "end_at": "14:15:00",
            "hours": 2.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 53,
        "task_id": 183,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 183,
            "name": "Automotive Technician",
            "start_at": "15:00:00",
            "end_at": "17:00:00",
            "hours": 2,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 54,
        "task_id": 189,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 189,
            "name": "Occupational Health Safety Specialist",
            "start_at": "10:45:00",
            "end_at": "11:00:00",
            "hours": 0.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 55,
        "task_id": 190,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 190,
            "name": "Supervisor Correctional Officer",
            "start_at": "17:00:00",
            "end_at": "17:45:00",
            "hours": 0.75,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 56,
        "task_id": 191,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 191,
            "name": "Lifeguard",
            "start_at": "10:00:00",
            "end_at": "10:15:00",
            "hours": 0.25,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 57,
        "task_id": 196,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 196,
            "name": "Agricultural Inspector",
            "start_at": "11:15:00",
            "end_at": "11:45:00",
            "hours": 0.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 58,
        "task_id": 199,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 199,
            "name": "Agricultural Worker",
            "start_at": "14:15:00",
            "end_at": "15:15:00",
            "hours": 1,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 59,
        "task_id": 200,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 200,
            "name": "Buffing and Polishing Operator",
            "start_at": "13:15:00",
            "end_at": "15:30:00",
            "hours": 2.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 60,
        "task_id": 208,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 208,
            "name": "Chemical Plant Operator",
            "start_at": "08:45:00",
            "end_at": "10:45:00",
            "hours": 2,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 61,
        "task_id": 213,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 213,
            "name": "Electronic Equipment Assembler",
            "start_at": "12:15:00",
            "end_at": "12:45:00",
            "hours": 0.5,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 62,
        "task_id": 217,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 217,
            "name": "Job Printer",
            "start_at": "12:45:00",
            "end_at": "13:45:00",
            "hours": 1,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 63,
        "task_id": 222,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 222,
            "name": "Claims Adjuster",
            "start_at": "08:15:00",
            "end_at": "08:30:00",
            "hours": 0.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 64,
        "task_id": 226,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 226,
            "name": "Bridge Tender OR Lock Tender",
            "start_at": "12:45:00",
            "end_at": "14:30:00",
            "hours": 1.75,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 65,
        "task_id": 231,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 231,
            "name": "Food Cooking Machine Operators",
            "start_at": "10:00:00",
            "end_at": "12:00:00",
            "hours": 2,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 66,
        "task_id": 232,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 232,
            "name": "Public Transportation Inspector",
            "start_at": "08:15:00",
            "end_at": "09:45:00",
            "hours": 1.5,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 67,
        "task_id": 246,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 246,
            "name": "Recreational Therapist",
            "start_at": "10:30:00",
            "end_at": "11:30:00",
            "hours": 1,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 68,
        "task_id": 248,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 248,
            "name": "Cashier",
            "start_at": "11:00:00",
            "end_at": "12:00:00",
            "hours": 1,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 69,
        "task_id": 251,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 251,
            "name": "Bailiff",
            "start_at": "10:00:00",
            "end_at": "11:45:00",
            "hours": 1.75,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 70,
        "task_id": 252,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 252,
            "name": "Architecture Teacher",
            "start_at": "12:45:00",
            "end_at": "13:45:00",
            "hours": 1,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 71,
        "task_id": 254,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 254,
            "name": "Medical Appliance Technician",
            "start_at": "10:30:00",
            "end_at": "12:15:00",
            "hours": 1.75,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 72,
        "task_id": 255,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 255,
            "name": "Chemical Equipment Operator",
            "start_at": "17:00:00",
            "end_at": "17:15:00",
            "hours": 0.25,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 73,
        "task_id": 262,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 262,
            "name": "Distribution Manager",
            "start_at": "17:30:00",
            "end_at": "18:30:00",
            "hours": 1,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 74,
        "task_id": 266,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 266,
            "name": "Communications Teacher",
            "start_at": "14:30:00",
            "end_at": "15:45:00",
            "hours": 1.25,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 75,
        "task_id": 279,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 279,
            "name": "Business Development Manager",
            "start_at": "15:15:00",
            "end_at": "16:45:00",
            "hours": 1.5,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 76,
        "task_id": 281,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 281,
            "name": "Healthcare Practitioner",
            "start_at": "16:30:00",
            "end_at": "17:00:00",
            "hours": 0.5,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 77,
        "task_id": 283,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 283,
            "name": "Music Arranger and Orchestrator",
            "start_at": "15:45:00",
            "end_at": "17:30:00",
            "hours": 1.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 78,
        "task_id": 286,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 286,
            "name": "Algorithm Developer",
            "start_at": "15:15:00",
            "end_at": "16:30:00",
            "hours": 1.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 79,
        "task_id": 292,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 292,
            "name": "Sheriff",
            "start_at": "12:30:00",
            "end_at": "13:00:00",
            "hours": 0.5,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 80,
        "task_id": 295,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 295,
            "name": "Security Guard",
            "start_at": "14:45:00",
            "end_at": "16:00:00",
            "hours": 1.25,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 81,
        "task_id": 299,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 299,
            "name": "Tour Guide",
            "start_at": "14:15:00",
            "end_at": "16:30:00",
            "hours": 2.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 82,
        "task_id": 301,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 301,
            "name": "Traffic Technician",
            "start_at": "17:00:00",
            "end_at": "18:15:00",
            "hours": 1.25,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 83,
        "task_id": 304,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 304,
            "name": "Purchasing Agent",
            "start_at": "15:30:00",
            "end_at": "15:45:00",
            "hours": 0.25,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 84,
        "task_id": 306,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 306,
            "name": "Elementary School Teacher",
            "start_at": "08:30:00",
            "end_at": "09:30:00",
            "hours": 1,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 85,
        "task_id": 311,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 311,
            "name": "General Farmworker",
            "start_at": "14:15:00",
            "end_at": "15:15:00",
            "hours": 1,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 86,
        "task_id": 313,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 313,
            "name": "PR Manager",
            "start_at": "15:45:00",
            "end_at": "17:45:00",
            "hours": 2,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 87,
        "task_id": 314,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 314,
            "name": "Operating Engineer",
            "start_at": "17:30:00",
            "end_at": "17:45:00",
            "hours": 0.25,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 88,
        "task_id": 316,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 316,
            "name": "Electronic Engineering Technician",
            "start_at": "10:30:00",
            "end_at": "11:15:00",
            "hours": 0.75,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 89,
        "task_id": 317,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 317,
            "name": "Licensing Examiner and Inspector",
            "start_at": "17:15:00",
            "end_at": "19:15:00",
            "hours": 2,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 90,
        "task_id": 318,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 318,
            "name": "Forest and Conservation Technician",
            "start_at": "17:15:00",
            "end_at": "19:00:00",
            "hours": 1.75,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 91,
        "task_id": 321,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 321,
            "name": "Social Worker",
            "start_at": "15:00:00",
            "end_at": "17:00:00",
            "hours": 2,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 92,
        "task_id": 328,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 328,
            "name": "CSI",
            "start_at": "11:15:00",
            "end_at": "12:00:00",
            "hours": 0.75,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 93,
        "task_id": 334,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 334,
            "name": "Telecommunications Line Installer",
            "start_at": "14:00:00",
            "end_at": "16:00:00",
            "hours": 2,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 94,
        "task_id": 351,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 351,
            "name": "Economics Teacher",
            "start_at": "10:45:00",
            "end_at": "12:15:00",
            "hours": 1.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 95,
        "task_id": 353,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 353,
            "name": "Boat Builder and Shipwright",
            "start_at": "13:45:00",
            "end_at": "15:15:00",
            "hours": 1.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 96,
        "task_id": 358,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 358,
            "name": "Art Director",
            "start_at": "11:30:00",
            "end_at": "11:45:00",
            "hours": 0.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 97,
        "task_id": 359,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 359,
            "name": "Engineering Teacher",
            "start_at": "16:45:00",
            "end_at": "18:45:00",
            "hours": 2,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 98,
        "task_id": 362,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 362,
            "name": "Gaming Surveillance Officer",
            "start_at": "17:30:00",
            "end_at": "18:00:00",
            "hours": 0.5,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 99,
        "task_id": 363,
        "state_id": 31,
        "preference": 0,
        "task": {
            "id": 363,
            "name": "Dental Assistant",
            "start_at": "09:45:00",
            "end_at": "10:45:00",
            "hours": 1,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 100,
        "task_id": 365,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 365,
            "name": "Security Systems Installer OR Fire Alarm Systems Installer",
            "start_at": "09:30:00",
            "end_at": "10:15:00",
            "hours": 0.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 101,
        "task_id": 369,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 369,
            "name": "MARCOM Director",
            "start_at": "15:45:00",
            "end_at": "16:30:00",
            "hours": 0.75,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 102,
        "task_id": 372,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 372,
            "name": "Numerical Control Machine Tool Operator",
            "start_at": "11:15:00",
            "end_at": "12:30:00",
            "hours": 1.25,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 103,
        "task_id": 373,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 373,
            "name": "Telemarketer",
            "start_at": "14:15:00",
            "end_at": "14:45:00",
            "hours": 0.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 104,
        "task_id": 384,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 384,
            "name": "Architectural Drafter",
            "start_at": "10:00:00",
            "end_at": "12:15:00",
            "hours": 2.25,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 105,
        "task_id": 391,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 391,
            "name": "Precision Mold and Pattern Caster",
            "start_at": "12:00:00",
            "end_at": "14:00:00",
            "hours": 2,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 106,
        "task_id": 394,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 394,
            "name": "Chemist",
            "start_at": "13:00:00",
            "end_at": "13:30:00",
            "hours": 0.5,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 107,
        "task_id": 395,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 395,
            "name": "Electronic Masking System Operator",
            "start_at": "09:45:00",
            "end_at": "10:45:00",
            "hours": 1,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 108,
        "task_id": 396,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 396,
            "name": "Extraction Worker",
            "start_at": "13:30:00",
            "end_at": "15:45:00",
            "hours": 2.25,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 109,
        "task_id": 398,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 398,
            "name": "Clerk",
            "start_at": "12:30:00",
            "end_at": "13:45:00",
            "hours": 1.25,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 110,
        "task_id": 399,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 399,
            "name": "Fabric Pressers",
            "start_at": "11:45:00",
            "end_at": "12:30:00",
            "hours": 0.75,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 111,
        "task_id": 406,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 406,
            "name": "Anthropologist OR Archeologist",
            "start_at": "12:15:00",
            "end_at": "14:15:00",
            "hours": 2,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 112,
        "task_id": 415,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 415,
            "name": "Computer Software Engineer",
            "start_at": "10:30:00",
            "end_at": "11:15:00",
            "hours": 0.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 113,
        "task_id": 417,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 417,
            "name": "Stone Sawyer",
            "start_at": "16:30:00",
            "end_at": "16:45:00",
            "hours": 0.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 114,
        "task_id": 426,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 426,
            "name": "Upholsterer",
            "start_at": "17:00:00",
            "end_at": "18:45:00",
            "hours": 1.75,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 115,
        "task_id": 428,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 428,
            "name": "Highway Maintenance Worker",
            "start_at": "09:45:00",
            "end_at": "11:30:00",
            "hours": 1.75,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 116,
        "task_id": 440,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 440,
            "name": "Social Scientists",
            "start_at": "08:00:00",
            "end_at": "08:15:00",
            "hours": 0.25,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 117,
        "task_id": 443,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 443,
            "name": "Brickmason",
            "start_at": "12:00:00",
            "end_at": "12:45:00",
            "hours": 0.75,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 118,
        "task_id": 447,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 447,
            "name": "Cafeteria Cook",
            "start_at": "17:15:00",
            "end_at": "19:00:00",
            "hours": 1.75,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 119,
        "task_id": 451,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 451,
            "name": "Photographic Restorer",
            "start_at": "08:45:00",
            "end_at": "10:30:00",
            "hours": 1.75,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 120,
        "task_id": 455,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 455,
            "name": "Occupational Therapist Aide",
            "start_at": "16:45:00",
            "end_at": "18:30:00",
            "hours": 1.75,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 121,
        "task_id": 456,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 456,
            "name": "Forming Machine Operator",
            "start_at": "18:00:00",
            "end_at": "20:00:00",
            "hours": 2,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 122,
        "task_id": 457,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 457,
            "name": "Drilling and Boring Machine Tool Setter",
            "start_at": "18:00:00",
            "end_at": "19:45:00",
            "hours": 1.75,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 123,
        "task_id": 458,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 458,
            "name": "Product Specialist",
            "start_at": "15:30:00",
            "end_at": "17:45:00",
            "hours": 2.25,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 124,
        "task_id": 461,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 461,
            "name": "Title Searcher",
            "start_at": "10:30:00",
            "end_at": "12:30:00",
            "hours": 2,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 125,
        "task_id": 463,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 463,
            "name": "Radiation Therapist",
            "start_at": "08:15:00",
            "end_at": "09:30:00",
            "hours": 1.25,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 126,
        "task_id": 467,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 467,
            "name": "Conservation Scientist",
            "start_at": "08:30:00",
            "end_at": "09:15:00",
            "hours": 0.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 127,
        "task_id": 468,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 468,
            "name": "Air Crew Member",
            "start_at": "09:00:00",
            "end_at": "11:15:00",
            "hours": 2.25,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 128,
        "task_id": 469,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 469,
            "name": "Engineering",
            "start_at": "11:15:00",
            "end_at": "13:15:00",
            "hours": 2,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 129,
        "task_id": 473,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 473,
            "name": "Housekeeping Supervisor",
            "start_at": "09:30:00",
            "end_at": "11:00:00",
            "hours": 1.5,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 130,
        "task_id": 474,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 474,
            "name": "Legal Support Worker",
            "start_at": "12:15:00",
            "end_at": "12:30:00",
            "hours": 0.25,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 131,
        "task_id": 483,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 483,
            "name": "Precision Pattern and Die Caster",
            "start_at": "16:00:00",
            "end_at": "16:15:00",
            "hours": 0.25,
            "date": "2020-07-07 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 132,
        "task_id": 488,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 488,
            "name": "Directory Assistance Operator",
            "start_at": "13:45:00",
            "end_at": "15:00:00",
            "hours": 1.25,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 133,
        "task_id": 492,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 492,
            "name": "Mathematical Scientist",
            "start_at": "10:15:00",
            "end_at": "12:00:00",
            "hours": 1.75,
            "date": "2020-07-05 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 134,
        "task_id": 494,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 494,
            "name": "Sawing Machine Tool Setter",
            "start_at": "14:30:00",
            "end_at": "16:30:00",
            "hours": 2,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 135,
        "task_id": 495,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 495,
            "name": "Anesthesiologist",
            "start_at": "18:00:00",
            "end_at": "20:15:00",
            "hours": 2.25,
            "date": "2020-07-06 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 136,
        "task_id": 498,
        "state_id": 31,
        "preference": 1,
        "task": {
            "id": 498,
            "name": "Electrical Sales Representative",
            "start_at": "09:30:00",
            "end_at": "11:45:00",
            "hours": 2.25,
            "date": "2020-07-09 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 137,
        "task_id": 499,
        "state_id": 31,
        "preference": 2,
        "task": {
            "id": 499,
            "name": "Refrigeration Mechanic",
            "start_at": "10:45:00",
            "end_at": "11:15:00",
            "hours": 0.5,
            "date": "2020-07-04 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    },
    {
        "id": 138,
        "task_id": 500,
        "state_id": 31,
        "preference": 3,
        "task": {
            "id": 500,
            "name": "Entertainer and Performer",
            "start_at": "08:45:00",
            "end_at": "09:00:00",
            "hours": 0.25,
            "date": "2020-07-08 00:00:00"
        },
        "state": {
            "id": 31,
            "name": "placed",
            "description": "The bid is waiting for the auction"
        }
    }
]
```

### HTTP Request
`GET api/v1/user/{user}/bid/{conference}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user` |  required  | The user's id
    `conference` |  required  | The conference's key

<!-- END_621dcdc4770a45b8129b12966db31c4d -->

<!-- START_dee066b50e1d0aff9f737cddd2f56f4f -->
## Get all notifications for a user of a given conference

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/user/1/notification/chi20" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/user/1/notification/chi20"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "total": 0,
    "notifications": []
}
```

### HTTP Request
`GET api/v1/user/{user}/notification/{conference}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user` |  required  | The user's id
    `conference` |  required  | The conference's key

<!-- END_dee066b50e1d0aff9f737cddd2f56f4f -->

<!-- START_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->
## Get all users

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/user?university_id=4044&university_fallback=%22Aachen%22&search=%22Admin%22&sort_by=lastname&sort_order=asc&per_page=2&page=1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/user"
);

let params = {
    "university_id": "4044",
    "university_fallback": ""Aachen"",
    "search": ""Admin"",
    "sort_by": "lastname",
    "sort_order": "asc",
    "per_page": "2",
    "page": "1",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "firstname": "ADMIN Milton",
            "lastname": "Waddams",
            "email": "admin@chisv.org",
            "university_id": "4011",
            "university_fallback": null,
            "university": {
                "id": 4011,
                "name": "Rajasthan Technical University"
            },
            "permissions": [
                {
                    "user_id": 1,
                    "conference_id": null,
                    "role": {
                        "id": 1,
                        "name": "admin",
                        "description": "Can do anything"
                    },
                    "state": null,
                    "conference": null
                },
                {
                    "user_id": 1,
                    "conference_id": 1,
                    "role": {
                        "id": 10,
                        "name": "sv",
                        "description": "Is associated for conferences as SV"
                    },
                    "state": {
                        "id": 11,
                        "name": "enrolled",
                        "description": "Waiting to be accepted, waitlisted or dropped"
                    },
                    "conference": {
                        "id": 1,
                        "name": "CHI 2020",
                        "key": "chi20"
                    }
                }
            ]
        }
    ],
    "first_page_url": "http:\/\/localhost:8000\/api\/v1\/user?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http:\/\/localhost:8000\/api\/v1\/user?page=1",
    "next_page_url": null,
    "path": "http:\/\/localhost:8000\/api\/v1\/user",
    "per_page": "25",
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```

### HTTP Request
`GET api/v1/user`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `university_id` |  optional  | int Limit to university by id
    `university_fallback` |  optional  | string Limit to university by name
    `search` |  optional  | string Search users by name
    `sort_by` |  optional  | string Sort by column
    `sort_order` |  optional  | string Sort order
    `per_page` |  optional  | int Results per page
    `page` |  optional  | int Show page

<!-- END_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->

<!-- START_a8f148df1f2cd4bc2d67314d2cb9fa3d -->
## Get a user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "https://chisv.org/api/v1/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": 1,
    "firstname": "Milton",
    "lastname": "Waddams",
    "country_id": "82",
    "university_fallback": null,
    "shirt_id": "1",
    "degree_id": "2",
    "email": "admin@chisv.org",
    "locale_id": "40",
    "past_conferences": null,
    "past_conferences_sv": null,
    "region_id": "1269",
    "location": {
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1269,
            "name": "North Rhine-Westphalia"
        },
        "city": {
            "id": 12850,
            "name": "Aachen"
        }
    },
    "avatar": null,
    "languages": [
        {
            "id": 10,
            "name": "Bashkir",
            "code": "ba",
            "pivot": {
                "user_id": "1",
                "language_id": "10"
            }
        },
        {
            "id": 13,
            "name": "Bihari",
            "code": "bh",
            "pivot": {
                "user_id": "1",
                "language_id": "13"
            }
        }
    ],
    "permissions": [
        {
            "id": 1,
            "user_id": 1,
            "conference_id": 1,
            "enrollment_form_id": 2,
            "conference": {
                "id": 1,
                "key": "chi20",
                "name": "CHI 2020",
                "state_id": 4,
                "state": {
                    "id": 4,
                    "name": "running",
                    "description": "The conference is running"
                },
                "artwork": null
            },
            "role": {
                "id": 10,
                "name": "sv",
                "description": "Is associated for conferences as SV"
            },
            "state": {
                "id": 12,
                "name": "accepted",
                "description": "Accepted to the conference as SV"
            },
            "enrollment_form": {
                "id": 2,
                "name": "Default",
                "body": "{\"header\":\"Please answer the following questions\",\"agreement\":\"Please read this carefully: SVs will work for approximately 14 hours during the conference\",\"fields\":{\"know_city\":{\"type\":\"boolean\",\"description\":\"Are you local to where the conference will be this year?\",\"hint\":\"If you get selected as a local volunteer you may be requested to do specific tasks that leverage that characteristic, like finding restaurants, helping with the Information desk, help with PC meeting, and others.\",\"value\":true,\"required\":true},\"attended_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you attended this conference before?\",\"value\":14,\"required\":true},\"sved_before\":{\"type\":\"integer\",\"range\":[0,99],\"description\":\"How many times have you been an SV at this conference before?\",\"value\":26,\"required\":false},\"need_visa\":{\"type\":\"boolean\",\"description\":\"Do you need to apply for a travel visa in order to attend this conference? (answer no if you are eligible for a VISA waiver program for the country of the conference)\",\"hint\":\"Choosing yes will make us send you some additional information via E-Mail. This preference will not be used when the lottery is run for selecting the SVs.\",\"value\":false,\"required\":true},\"why_you_want_to_be_sv\":{\"type\":\"string\",\"description\":\"Please explain why you want to be an SV at the conference:\",\"maxlength\":2000,\"value\":\"Error sint qui vel ipsam. Sequi optio rerum et praesentium asperiores sequi non. Et voluptatem est odit totam voluptatem culpa accusantium.\",\"required\":true}}}"
            },
            "user": {
                "id": 1
            }
        },
        {
            "id": 12,
            "user_id": 1,
            "conference_id": null,
            "enrollment_form_id": null,
            "conference": null,
            "role": {
                "id": 1,
                "name": "admin",
                "description": "Can do anything"
            },
            "state": null,
            "enrollment_form": null,
            "user": {
                "id": 1
            }
        }
    ],
    "locale": {
        "id": 40,
        "code": "en",
        "name": "English (United States)"
    },
    "university": {
        "id": 4011,
        "name": "Rajasthan Technical University",
        "url": "http:\/\/www.rtu.ac.in\/"
    },
    "city": {
        "id": 12850,
        "name": "Aachen"
    },
    "country": {
        "id": 82,
        "name": "Germany"
    },
    "region": {
        "id": 1269,
        "name": "North Rhine-Westphalia"
    }
}
```

### HTTP Request
`GET api/v1/user/{user}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user` |  optional  | The user's id

<!-- END_a8f148df1f2cd4bc2d67314d2cb9fa3d -->

<!-- START_1006d782d67bb58039bde349972eb2f0 -->
## Update a user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "https://chisv.org/api/v1/user/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0" \
    -d '{"firstname":"Jacob","lastname":"Smith","email":"jacob@example.com","languages":[{"id":23}],"location":{"country":{"id":82,"name":"Germany"},"region":{"id":1268,"name":"Nordrhein-Westfalen"},"city":{"id":12850,"name":"Aachen"}},"university":{"id":4044,"name":"RWTH Aachen"},"degree_id":2,"shirt_id":3,"locale_id":51,"past_conferences":["CHI 2019"],"past_conferences_sv":["CHI 2019"],"password":"secret","password_confirmation":"secret"}'

```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/user/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

let body = {
    "firstname": "Jacob",
    "lastname": "Smith",
    "email": "jacob@example.com",
    "languages": [
        {
            "id": 23
        }
    ],
    "location": {
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1268,
            "name": "Nordrhein-Westfalen"
        },
        "city": {
            "id": 12850,
            "name": "Aachen"
        }
    },
    "university": {
        "id": 4044,
        "name": "RWTH Aachen"
    },
    "degree_id": 2,
    "shirt_id": 3,
    "locale_id": 51,
    "past_conferences": [
        "CHI 2019"
    ],
    "past_conferences_sv": [
        "CHI 2019"
    ],
    "password": "secret",
    "password_confirmation": "secret"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": {
        "id": 1,
        "firstname": "Jacob",
        "lastname": "Smith",
        "country_id": 82,
        "university_id": 4044,
        "university_fallback": null,
        "shirt_id": 3,
        "degree_id": 2,
        "email": "jacob@example.com",
        "email_verified_at": "2020-07-07 14:53:12",
        "locale_id": 51,
        "created_at": "2020-07-07 14:53:12",
        "updated_at": "2020-07-07 14:57:09",
        "past_conferences": [
            "CHI 2019"
        ],
        "past_conferences_sv": [
            "CHI 2019"
        ],
        "region_id": 1268,
        "city_id": 12850,
        "location": {
            "country": {
                "id": 82,
                "name": "Germany"
            },
            "region": {
                "id": 1268,
                "name": "Nordrhein-Westfalen"
            },
            "city": {
                "id": 12850,
                "name": "Aachen"
            }
        },
        "languages": [
            {
                "id": 10,
                "name": "Bashkir",
                "code": "ba",
                "pivot": {
                    "user_id": "1",
                    "language_id": "10"
                }
            },
            {
                "id": 13,
                "name": "Bihari",
                "code": "bh",
                "pivot": {
                    "user_id": "1",
                    "language_id": "13"
                }
            }
        ],
        "country": {
            "id": 82,
            "name": "Germany"
        },
        "region": {
            "id": 1268,
            "name": "Nordrhein-Westfalen"
        },
        "city": {
            "id": 12850,
            "name": "Aachen"
        },
        "avatar": null,
        "permissions": [
            {
                "id": 1,
                "user_id": 1,
                "conference_id": 1,
                "created_at": "2020-07-07 14:53:12",
                "updated_at": "2020-07-07 14:53:12",
                "enrollment_form_id": 2,
                "lottery_position": null,
                "conference": {
                    "id": 1,
                    "name": "CHI 2020",
                    "key": "chi20",
                    "location": "Honolulu, Hawaiʻi, USA",
                    "timezone_id": 366,
                    "start_date": "2020-07-04",
                    "end_date": "2020-07-10",
                    "description": "##Aloha!\n\nThe ACM CHI Conference on Human Factors in Computing Systems is the premier international conference of Human-Computer Interaction. __CHI__ – pronounced ‘kai’ – is a place where researchers and practitioners gather from across the world to discuss the latest in interactive technology. We are a multicultural community from highly diverse backgrounds who together investigate and design new and creative ways for people to interact using technology.\n\n###From April 25th to 30th\nCHI will, for the first time, take place in beautiful __Honolulu__, on the island of Oahu, Hawaiʻi, USA. Mahalo! Regina Bernhaupt and Florian ‘Floyd’ Mueller CHI 2020 General Chairs [generalchairs@chi2020.acm.org](mailto:generalchairs@chi2020.acm.org)",
                    "enrollment_form_id": 1,
                    "state_id": 4,
                    "url": "https:\/\/www.acm.org\/",
                    "url_name": "ACM",
                    "created_at": "2020-07-07 14:53:10",
                    "updated_at": "2020-07-07 14:53:10",
                    "volunteer_hours": 20,
                    "volunteer_max": 100,
                    "email_chair": "noreply@chisv.org",
                    "bidding_start": "2020-07-07 14:53:10",
                    "bidding_end": "2020-07-10 00:00:00",
                    "bidding_enabled": true,
                    "artwork": null
                },
                "role": {
                    "id": 10,
                    "name": "sv",
                    "description": "Is associated for conferences as SV"
                },
                "state": {
                    "id": 12,
                    "name": "accepted",
                    "for": "App\\User",
                    "description": "Accepted to the conference as SV"
                }
            },
            {
                "id": 12,
                "user_id": 1,
                "conference_id": null,
                "created_at": "2020-07-07 14:53:12",
                "updated_at": "2020-07-07 14:53:12",
                "enrollment_form_id": null,
                "lottery_position": null,
                "conference": null,
                "role": {
                    "id": 1,
                    "name": "admin",
                    "description": "Can do anything"
                },
                "state": null
            }
        ],
        "university": {
            "id": 4044,
            "name": "Rheinisch Westfälische Technische Hochschule Aachen",
            "url": "http:\/\/www.rwth-aachen.de\/"
        }
    },
    "message": "User updated"
}
```

### HTTP Request
`PUT api/v1/user/{user}`

`PATCH api/v1/user/{user}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user` |  optional  | int required The user's id
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `firstname` | string |  required  | The user's first name
        `lastname` | string |  required  | The user's last name
        `email` | string |  required  | The user's email
        `languages` | array&lt;[Language](#get-all-languages-matching-a-pattern)&gt; |  optional  | An array of languages
        `languages.*.id` | integer |  required  | A [language's](#get-all-languages-matching-a-pattern) id
        `location` | [Location](#get-all-locations-for-a-country-by-city-name) |  required  | The users location by city name
        `location.country.id` | integer |  required  | The location's country id
        `location.country.name` | string |  optional  | The location's country name
        `location.region.id` | integer |  optional  | The location's region id
        `location.region.name` | string |  optional  | The location's region name
        `location.city.id` | integer |  optional  | The location's city id
        `location.city.name` | string |  optional  | The location's city name
        `university.id` | integer |  optional  | The [university's](#get-all-universities-matching-a-pattern) id
        `university.name` | string |  optional  | The fallback university's name if no id used (see above)
        `degree_id` | integer |  required  | The user's [degree](#get-all-degrees)
        `shirt_id` | integer |  required  | The user's [shirt](#get-all-t-shirts)
        `locale_id` | integer |  required  | The user's [locale](#get-all-locales)
        `past_conferences` | array&lt;string&gt; |  optional  | The user's past attended conferences as array
        `past_conferences.*` | string |  optional  | A user's past attended conference
        `past_conferences_sv` | array&lt;string&gt; |  optional  | The user's past attended conferences as SV as array
        `past_conferences_sv.*` | string |  optional  | A user's past attended conference as SV
        `password` | string |  optional  | The user's password
        `password_confirmation` | string |  optional  | The user's password
    
<!-- END_1006d782d67bb58039bde349972eb2f0 -->

<!-- START_a5d7655acadc1b6c97d48e68f1e87be9 -->
## Delete a user

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "https://chisv.org/api/v1/user/2" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0"
```

```javascript
const url = new URL(
    "https://chisv.org/api/v1/user/2"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjFmMGRkOWQ5ZGVjMTkzOWRlYzU4Yjk0NzBkMTMwZDEzOTFmYmQ3Y2Y2MDdhOWU0MWM4NWMxODI2YWUzODk2NzIzNmEwODdjYTYxMjdlNTYxIn0.eyJhdWQiOiIyIiwianRpIjoiMWYwZGQ5ZDlkZWMxOTM5ZGVjNThiOTQ3MGQxMzBkMTM5MWZiZDdjZjYwN2E5ZTQxYzg1YzE4MjZhZTM4OTY3MjM2YTA4N2NhNjEyN2U1NjEiLCJpYXQiOjE1OTQxMzM3MTIsIm5iZiI6MTU5NDEzMzcxMiwiZXhwIjoxNjI1NjY5NzEyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.oBxP9u445tDWNXziBwTi10ukRP2j9uP3-3UbGFET8YyNHnM_VUQqr-JlKqw5pRVH6pLnWmIO8Y7VploNQotcmQjgwwwi8IuGconVipGI66qNSKWGX6mDQYR-GDt6JtHDn1qSaDgbOfD5UObDmEvz9t2QA48ZINs79O9XXRe4qIYThHuVIuYgVafOXaCgu_TSgZDj-GkjLWR85wlhqRxzmbTn9Gn2eQOxNBVHd-hvZWHtOu88DsdzIUYLgPzz5jxye_b1Jl2WfYIf3zCK3knRFYpKUIzLYgBqjuJGLXo8yGfrfz2QDHE7i87ri-CiE6QlC4Hb7SZAQ9kaoNLoJm81P8maJVztp3fddfSNNdXDxgqoI9kPJEjUsnMUm_OJIO90TNn97RcTxH2p9ocxFrPOkh4Tm_QF8BC5brKPG7-NIM6mWVGsm6_CwqA1dEYaWTdOI7SiLj6pvIywy4pkR85cncdbzMuwIZywk2YxeUbm0vWx1N-rgTE-yOXLwGS-rVXU7RWMKsqV_ESP5wiGjD9yY2JVYAwN7CIa0NaI1h65URjXzyacmaTXYKBCgxHLPfH5ecBza_Y4eQ8wr0eIJN0e9WRUPHB6P131E0k7kZwDB7IlSON8esN4ypdHs_zm-ItXneG3njS71jEXufTNypOsp_c1fQ9IGBxC1uwwSNFScN0",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "User deleted"
}
```
> Example response (403):

```json
{
    "message": "This action is unauthorized."
}
```

### HTTP Request
`DELETE api/v1/user/{user}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `user` |  required  | The user's id

<!-- END_a5d7655acadc1b6c97d48e68f1e87be9 -->


