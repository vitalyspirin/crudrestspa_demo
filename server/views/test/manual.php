<div class="site-index">

    <div class="jumbotron">
        <p class="lead">Testing RESTful API.</p>
    </div>

    <div class="body-content tests">

        <form action="/server/web/v1/users" method="post">
            <fieldset>
                <legend>Create new user:</legend>
                <input type="text" name="user_email" value="vitaly.spirin@gmail.com" />
                <input type="text" name="user_firstname" value="Vitaly" />
                <input type="text" name="user_lastname" value="Spirin" />
                <input type="text" name="user_password" value="vitaly" />
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/users" method="post">
            <fieldset>
                <legend>Login existing user:</legend>
                <input type="text" name="user_email" value="vitaly.spirin@gmail.com" />
                <input type="text" name="user_password" value="vitaly" />
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/user/roles" method="get">
            <fieldset>
                <legend>Show user roles:</legend>
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/calories/user/1" method="get">
            <fieldset>
                <legend>Show calories for user 1 (Vitaly Spirin):</legend>
                <input type="text" name="user_accesstoken" value="PEp982aMnzjjTFqItf8ORva0J9LgWGBt" />
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/calories/labels" method="get">
            <fieldset>
                <legend>Show calories labels:</legend>
                <input type="text" name="user_accesstoken" value="PEp982aMnzjjTFqItf8ORva0J9LgWGBt" />
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/user/labels" method="get">
            <fieldset>
                <legend>Show user labels:</legend>
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/users" method="get">
            <fieldset>
                <legend>Show all existing users:</legend>
                <input type="text" name="user_accesstoken" value="LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS" />
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/users/1" method="get">
            <fieldset>
                <legend>Show users 1:</legend>
                <input type="text" name="user_accesstoken" value="LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS" />
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/users" method="post">
            <fieldset>
                <legend>Show OPTIONS for users:</legend>
                <input type="text" name="user_accesstoken" value="LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS" />
                <input type="hidden" name="_method" value="OPTIONS" />
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/users?user_accesstoken=LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS" method="post">
            <fieldset>
                <legend>Test:</legend>
                <button>Submit</button>
            </fieldset>
        </form>

<hr />

        <form action="/server/web/v1/calories/user/1/search?user_accesstoken=LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS" method="post">
            <fieldset>
                <input type="text" name="fromDate" value="2016-04-06" />
                <legend>Search:</legend>
                <button>Submit</button>
            </fieldset>
        </form>

        <form action="/server/web/v1/calories/1?user_accesstoken=LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS" method="post">
            <fieldset>
                <legend>Get Calories #1:</legend>
                <input type="text" name="user_accesstoken" value="LOnYG6a2BkWIgyjGZjVQqC7AtbP_IIlS" />
                <button>Submit</button>
            </fieldset>
        </form>

    </div>
</div>
