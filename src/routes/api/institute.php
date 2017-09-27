<?php
use Api\Models\Country;
use Api\Models\District;
use Api\Models\Region;
use Api\Models\Institution;
use Api\Models\Wards;

$app->get('/institute[/[{id}]]', function ($request, $response, $args) use ($container) {

    $user_token_id = $request->getAttribute("user_token_id");

    if($user_token_id == null)
    {
        //  return json_encode([ 'status' => 'success', 'response' => 'Sorry, You must login first' ]);
    }

    if(isset($args['id'])){
        $ret =  Institution::whereRaw('status = ? and institution_id = ?', [ 1, $args['id'] ])
                ->with('types', 'user', 'region', 'district', 'ward')
                ->get()->toArray();
    } else {
        $ret =  Institution::whereRaw('status = ?', [ 1 ])
                ->with('types', 'user', 'region', 'district', 'ward')
                ->limit(25)->offset(0)
                ->orderBy('institution_id', 'desc')
                ->get()->toArray();
    }


    if(isset($ret[0]['institution_id'])){

        //  remove username and password
        foreach ($ret as $key => $rt) {
           unset($ret[ $key ]['user']['username'], $ret[ $key ]['user']['password']);
        }

        return json_encode([ 'status' => 'success', 'response' => $ret ]);
    }

    return json_encode([ 'status' => 'failed', 'response' => null ]);
});

$app->post('/create/institute', function ($request, $response) use ($container) {

    $user_token_id = $request->getAttribute("user_token_id");

    if($user_token_id != null)
    {

        $institute = $request->getParsedBody();
        $institute['user_id'] = $user_token_id;

        $insid = Institution::insertGetId($institute, 'institution_id');
        $insti = Institution::where('institution_id', '=', $insid)->get()->toArray();

        return json_encode($insti);
    }

    return null;
})->add($mdw);

$app->post('/search/institute', function ($request, $response) use ($container) {
    $data = $request->getParsedBody();

    /* The Usage */
    $data = array(
        'keyword'     => ((isset($data['keyword']))?     $data['keyword'] :     ''),
        'region_id'   => ((isset($data['region_id']))?   $data['region_id'] * 1 :   0),
        'district_id' => ((isset($data['district_id']))? $data['district_id'] * 1 : 0),
        'type_id'     => ((isset($data['type_id']))?     $data['type_id'] :     ''),
    );

    $ret =  Institution::whereRaw('status = ? and name LIKE ?', [ 1, '%'. $data['keyword'] .'%' ])->whereHas('types', function ($query) use ($data) { $query->where('type_id', 'like', '%'. $data['type_id'] .'%'); })
    ->when( (($data['region_id'] * 1) > 0 and ($data['district_id'] * 1) > 0) , function ($query) use ($data) {
        return $query->whereHas('district', function ($query) use ($data) { $query->where('district_id', '=', $data['district_id']); })->whereHas('region', function ($query) use ($data) { $query->where('region_id', '=', $data['region_id']); });
    })
    ->when( (($data['region_id'] * 1) > 0 and ($data['district_id'] * 1) == 0), function ($query) use ($data) {
        return $query->whereHas('region', function ($query) use ($data) { $query->where('region_id', '=', $data['region_id']); });
    })
    ->when( (($data['region_id'] * 1) == 0 and ($data['district_id'] * 1) > 0), function ($query) use ($data) {
        return $query->whereHas('district', function ($query) use ($data) { $query->where('district_id', '=', $data['district_id']); });
    })
    ->with('types', 'user', 'region', 'district', 'ward')->get()->toArray();

    if(isset($ret[0]['institution_id'])){
        return json_encode([ 'status' => 'success', 'response' => $ret ]);
    }

    return json_encode([ 'status' => 'failed', 'response' => null ]);
});

$app->post('/update/institute', function ($request, $response, $args) use ($container) {

    $user_token_id = $request->getAttribute("user_token_id");

    if($user_token_id != null)
    {

        $institute = $request->getParsedBody();
        $institute['user_id'] = $user_token_id;
        $insid = $institute['institution_id'];

        $updat = Institution::where('institution_id', '=', $insid)->update($institute);
        $insti = Institution::where('institution_id', '=', $insid)->get()->toArray();

        return json_encode($insti);
    }

    return null;
})->add($mdw);

$app->delete('/delete/institute[/[{id}]]', function ($request, $response, $args) use ($container) {

    $user_token_id = $request->getAttribute("user_token_id");

    if($user_token_id != null)
    {
        if(isset($args['id'])){
            $ret =  Institution::whereRaw('status = ? and institution_id = ?', [ 1, $args['id'] ])
                    ->with('types', 'user', 'region', 'district', 'ward')
                    ->get()->toArray();
        }

        if(isset($ret[0]['institution_id'])){

            //  remove username and password
            $delete = Institution::where('institution_id', '=', $args['id'])->delete();
            if($delete){
                return json_encode([ 'status' => 'success', 'response' => $ret ]);
            }

        }
    }

    return json_encode([ 'status' => 'failed', 'response' => null ]);
})->add($mdw);
