
function User($resource) 
{
    var actions = 
        {
                'get':    {method:'GET', 
                           interceptor : {responseError : resourceErrorHandler}
                },
                'save':   {method:'POST',
                    interceptor : {responseError : resourceErrorHandler}
                },
                'update': { method:'PUT',
                    interceptor : {responseError : resourceErrorHandler}
                },
                'query':  {method:'GET', isArray:true, 
                           interceptor : {responseError : resourceErrorHandler}
                },
                'delete': {method:'DELETE'
                },
                'getLabels':  {method:'GET', url: APIURLs.userLabels(),
                           interceptor : {responseError : resourceErrorHandler}
                },
                'getRoles':  {method:'GET',  isArray:true, url: APIURLs.userRoles(),
                           interceptor : {responseError : resourceErrorHandler}
                },
        };
        
        
    return $resource(APIURLs.users(), {} , actions);

};
