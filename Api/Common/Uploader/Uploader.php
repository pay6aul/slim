<?php
namespace Api\Common\Uploader;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

use Api\Controllers\Controllers as Controller;
use Api\Common\Uploader\PluploadHandler as PluploadHandler;
use Api\Models\Attachment as Attachment;

class Uploader extends Controller
{

	public function startUploading(Request $request, Response $response, $args)
	{
		$data = $request->getParsedBody();
		$data = [
			'post_type' => (isset($data['post_type']))? $data['post_type'] : 'UPLOADS',
			'doc_type' => (isset($data['doc_type']))? $data['doc_type'] : 'UPLOADS',
		];

		$thepath = $this->upload_directory ;

		$ph = new PluploadHandler(array(
			//	'target_dir' => '../common/api/uploads/',
			'target_dir' => $thepath,
	        'allow_extensions' => 'jpg,jpeg,gif,png,pdf,doc,docx,xls,zip,xlsx'
	    ));

	    $ph->sendNoCacheHeaders();
	    $ph->sendCORSHeaders();

	    if ($result = $ph->handleUpload()) {

			$result['path'] = RMP_BACKEND . 'common/api/upload/'. $result['name'];

			if(substr($result['path'], 0, 7) == 'http://' || substr($result['path'], 0, 8) == 'https://'){
				$result['attach_id'] = Attachment::insertGetId(
					[
						'post_type'	=> $data['post_type'],
						'doc_type' 	=> $data['doc_type'],
						'filepath' 	=> $result['path'],
						'filename' 	=> $result['name']
					],
					'id'
				);

				return (json_encode([
		    		'status' => 'success',
					'error' => [
						'errorno' => null,
						'message' => null
					],
					'info' => $result
		    	]));
			} else {
				return (json_encode([
		    		'status' => 'failed',
					'error' => [
						'errorno' => null,
						'message' => 'failed to save'
					],
					'info' => null
		    	]));
			}

	    } else {
	    	return (json_encode([
	    		'status' => 'failed',
				'error' => [
					'errorno' => $ph->getErrorCode(),
					'message' => $ph->getErrorMessage()
				],
				'info' => null
	    	]));
	    }

	    return null;
	}
}
