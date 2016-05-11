
function Calories($resource) 
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
                'query':  {method:'GET', isArray:true, url: APIURLs.caloriesIndex(),
                           interceptor : {responseError : resourceErrorHandler}
                },
                'search':  {method:'GET', isArray:true, url: APIURLs.caloriesSearch(),
                           interceptor : {responseError : resourceErrorHandler}
                },
                'delete': {method:'DELETE'
                },
                'getLabels':  {method:'GET', url: APIURLs.caloriesLabels(),
                           interceptor : {responseError : resourceErrorHandler}
                },
        };
        
        
    return $resource(APIURLs.calories(), {} , actions);

};
