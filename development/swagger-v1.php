
<?php
/**
 * @OpenApi\swagger(
 *     schemes={"http"},
 *     host=API_HOST,
 *     basePath="/",
 *     @OA\Info(
 *         version="3.0.0",
 *         title="Laravel and Swagger",
 *         description="Getting started with Laravel and Swagger",
 *         termsOfService="",
 *         @OA\Contact(
 *             email="dhaval48@gmail.com"
 *         ),
 *     ),
 *	   Authorization = bearer <token>,
 * 	   @OA\SecurityScheme(
 *      	securityScheme="default",
 *      	in="header",
 *      	name="Authorization",
 *      	type="apiKey",
 *      	scheme="bearer",
 * 	   ),
 * ),


/**
 * @OA\Post(
 *     path="/oauth/token",
 *     description="Client Authentication!",
 *     @OA\RequestBody(
 *     		required=true,
 *     		@OA\MediaType(
 *       		mediaType="application/json",
 *       		@OA\Schema(
 *         			@OA\Property(
 *           			property="grant_type",
 *           			description="Add grant type",
 *           			type="string",
 *         			),

 *         			@OA\Property(
 *           			property="client_id",
 *           			description="Add Client Id",
 *           			type="integer",
 *         			),

 *         			@OA\Property(
 *           			property="client_secret",
 *           			description="Add Client Secret",
 *           			type="string",
 *         			),

 *         			@OA\Property(
 *           			property="scope",
 *           			description="Add scope",
 *           			type="string",
 *         			),
 *       		),
 *     		),
 *   	),

 *     @OA\Response(response=405, description="Invalid input", @OA\JsonContent()),
 *     @OA\Response(response="200", description="Authenticated!", @OA\JsonContent()),
 *     @OA\Response(response="422", description="Somethings goes wrong.", @OA\JsonContent()),
 * )
 */