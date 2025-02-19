<?php

namespace App\Http\Controllers\GraphQLApi;

use App\Http\Controllers\Controller;

class GraphQLController extends Controller
{
    public function graphQLFunc(Request $request)
    {
        $query = $request->input('query');
        $variables = $request->input('variables');

        return GraphQL::executeQuery($query, $variables);



        /*
         query QueryName {
          fieldName {
            subField1
            subField2 {
              nestedSubField
            }
          }
        }
        //////////////////////for example : example 1
        query {
          products {
            id
            name
            description
            price
            category {
              id
              name
            }
            brand {
              id
              name
            }
            color {
              id
              name
            }
          }
        }
        ////////////////////////////////////////
        

         */
    }
}
