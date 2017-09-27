<?php
namespace Api\Common\Helpers;
/**
* The HelloWorld program implements an application that
* simply displays "Hello World!" to the standard output.
*
* @author  Paul Sosthenes
* @version 1.0
* @since   2017-06-31
*/

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

use Api\Common\Common as Common;
use Api\Controller\Controller as Controller;

class FileUploader extends Controller
{

    function TheUploader(Request $request, Response $response, $input_name)
    {
        $directory = $this->upload_directory ;

        $uploadedFiles = $request->getUploadedFiles();
        if(!isset($uploadedFiles[ $input_name ])){
            return null;
        }

        /*
            ONLY if the file input was set then start uploading the file
        */
        $uploadedFile = $uploadedFiles[ $input_name ];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {

            $filename = $this->http_path .'/'. self::moveUploadedFile($directory, $uploadedFile);
            //  var_dump($filename);
            if ( $filename != null ) {
                return $filename;
            }

            return null;
        }

        return null;
    }

    function moveUploadedFile($directory, UploadedFile $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basenames = bin2hex(random_bytes(26));
        $filenames = sprintf('%s.%0.8s', $basenames, $extension);

        if( $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filenames) ){
            return $filenames;
        }

        return $filenames;
    }

}
