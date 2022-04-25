<?php

namespace App\Services;

use App\PcvlUpload;

Class PcvlService {

    public function getMultiplePcvl($pcvlVotersFullName, $limit, $paginated, $page = 1)
    {
        $pcvlModel = new PcvlUpload();

        if($pcvlVotersFullName != 'pcvlVotersFullName'){
            $pcvlModel = $pcvlModel->where('pcvl_upload.pcvlUploadVotersName', 'LIKE', "%{$pcvlVotersFullName}%");
        }

        if($paginated === true){
            $offset = ($page >= 3) ? ($page * $limit) - $limit : (($page == 2) ? $limit : 0);
            $pcvlModel = $pcvlModel->offset($offset);
            $pcvlModel = $pcvlModel->limit($limit)->get();

            return $pcvlModel;
        }elseif($paginated == 'web'){
            $pcvlModel = $pcvlModel->paginate($limit);

            return $pcvlModel;
        }
        $pcvlModel = $pcvlModel->limit($limit)->get();

        return $pcvlModel;
    }
    
}
