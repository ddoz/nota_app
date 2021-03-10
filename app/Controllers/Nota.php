<?php

namespace App\Controllers;

use App\Models\NotaModel;
use App\Models\SetupModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class Nota extends BaseController
{

    public function __construct()
    {
        // inisialisasi class Auth dengan $this->protect
        $this->protect = new Auth();
        $this->ID = 0;
    }

    /**
     * Get all Notas
     * @return Response
     */
    public function index()
    {
        $this->getData();
        $model = new NotaModel();
        return $this->getResponse(
            [
                'message' => 'Notas retrieved successfully',
                'notas' => $model->findNotaByUser($this->ID)
            ]
        );            
        return $this->request;        
    }

    /**
     * Get setup nota
     * @return Response
     */
    public function setup()
    {
        $this->getData();
        $model = new SetupModel();
        return $this->getResponse(
            [
                'message' => 'Setup retrieved successfully',
                'notas' => $model->findSetupByUser($this->ID)
            ]
        );            
        return $this->request;        
    }

    /**
     * Create a new notas
     */
    public function storesetup()
    {
             
        $this->getData();

        $file = $this->request->getFile('logo');
        $watermark = $this->request->getFile('watermark');

        $logo_db = "";
        $watermark_db = "";

        $model = new SetupModel();

        if($file && $file->isValid()) {
            $name = $file->getName();// Mengetahui Nama File
            $originalName = $file->getClientName();// Mengetahui Nama Asli
            $tempfile = $file->getTempName();// Mengetahui Nama TMP File name
            $ext = $file->getClientExtension();// Mengetahui extensi File
            $type = $file->getClientMimeType();// Mengetahui Mime File
            $size_kb = $file->getSize('kb'); // Mengetahui Ukuran File dalam kb
            $size_mb = $file->getSize('mb');// Mengetahui Ukuran File dalam mb    
            
            //$namabaru = $file->getRandomName();//define nama fiel yang baru secara acak
            
            if ($type == (('image/png') or ('image/jpeg')))
            {	// File Tipe Sesuai
                $image = \Config\Services::image('gd'); //Load Image Libray
                $info = $image->withFile($file)->getFile()->getProperties(true); //Mendapatkan Files Propertis
                $width = $info['width'];// Mengetahui Image Width
                $height = $info['height'];// Mengetahui Image Height
    
                helper('filesystem'); // Load Helper File System
                $direktori = ROOTPATH.'upload'; //definisikan direktori upload
                $namabaru = 'LOGO_'.$this->ID.'.jpg'; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori
    
                /* Cek File apakah ada */
                foreach ($map as $key) {
                    if ($key == $namabaru){
                        delete_files($direktori,$namabaru); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->store($direktori, $namabaru);
                //$file->move($direktori, $namabaru)
                if ($file->move($direktori, $namabaru)){                                                                
                    $logo_db = $namabaru;
                }else{
                    return $this
                        ->getResponse(
                            'Gagal upload file',
                            ResponseInterface::HTTP_BAD_REQUEST
                        );
                }
            }else{
                // File Tipe Tidak Sesuai
                return $this
                    ->getResponse(
                        "Format file tidak didukung",
                        ResponseInterface::HTTP_BAD_REQUEST
                    );
            }
        }

        if($watermark && $watermark->isValid()) {
            $name = $watermark->getName();// Mengetahui Nama File
            $originalName = $watermark->getClientName();// Mengetahui Nama Asli
            $tempfile = $watermark->getTempName();// Mengetahui Nama TMP File name
            $ext = $watermark->getClientExtension();// Mengetahui extensi File
            $type = $watermark->getClientMimeType();// Mengetahui Mime File
            $size_kb = $watermark->getSize('kb'); // Mengetahui Ukuran File dalam kb
            $size_mb = $watermark->getSize('mb');// Mengetahui Ukuran File dalam mb    
            
            //$namabaru = $watermark->getRandomName();//define nama fiel yang baru secara acak
            
            if ($type == (('image/png') or ('image/jpeg')))
            {	// File Tipe Sesuai
                $image = \Config\Services::image('gd'); //Load Image Libray
                $info = $image->withFile($watermark)->getFile()->getProperties(true); //Mendapatkan Files Propertis
                $width = $info['width'];// Mengetahui Image Width
                $height = $info['height'];// Mengetahui Image Height
    
                helper('filesystem'); // Load Helper File System
                $direktori = ROOTPATH.'upload'; //definisikan direktori upload
                $namabaru = 'WATERMARK_'.$this->ID.'.jpg'; //definisikan nama fiel yang baru
                $map = directory_map($direktori, FALSE, TRUE); // List direktori
    
                /* Cek File apakah ada */
                foreach ($map as $key) {
                    if ($key == $namabaru){
                        delete_files($direktori,$namabaru); //Hapus terlebih dahulu jika file ada
                    }
                }
                //Metode Upload Pilih salah satu
                //$path = $this->request->getFile('uploadedFile')->store($direktori, $namabaru);
                //$watermark->move($direktori, $namabaru)
                if ($watermark->move($direktori, $namabaru)){                                        
                    $watermark_db = $namabaru;
                }else{
                    return $this
                                ->getResponse(
                                    'Gagal upload file',
                                    ResponseInterface::HTTP_BAD_REQUEST
                                );
                }
            }else{
                // File Tipe Tidak Sesuai
                return $this
                    ->getResponse(
                        "Format file tidak didukung",
                        ResponseInterface::HTTP_BAD_REQUEST
                    );
            }
        }

        if($logo_db != '' || $watermark_db != '') {

            $cekdata = $model->where('user_id',$this->ID)->first();

            if($cekdata != null) {
                $update = [
                    "logo" => $logo_db,
                    "watermark" => $watermark_db
                ];
                if($logo_db == "") {
                    unset($update['logo']);
                }
                if($watermark_db == "") {
                    unset($update['watermark']);
                }
                $model->update($cekdata['id'],$update);
                
                $setup = $model->where('id', $cekdata['id'])->first();
            }else {
                $data['logo'] = $logo_db;
                $data['watermark'] = $watermark_db;
                $data['user_id'] = $this->ID;
                $model->save($data);
                
                $setup = $model->where('id', $model->insertId())->first();
            }
            
            return $this->getResponse(
                [
                    'message' => 'Setup added successfully',
                    'setup' => $setup
                ]
            );
        } else {
            return $this
                ->getResponse(
                    ["error"=>"Error input file"],
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }
        
    }

    /**
     * Create a new notas
     */
    public function store()
    {
        $this->getData();
        $rules = [
            'judul' => 'required',
            'terima_dari' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        $model = new NotaModel();
        $input['user_id'] = $this->ID;
        $model->save($input);
        
        $nota = $model->where('id', $model->insertId())->first();

        return $this->getResponse(
            [
                'message' => 'Nota added successfully',
                'nota' => $nota
            ]
        );
    }

    /**
     * Get a single nota by ID
     */
    public function show($id)
    {
        try {

            $model = new NotaModel();
            $nota = $model->findNotaById($id);

            return $this->getResponse(
                [
                    'message' => 'Nota retrieved successfully',
                    'nota' => $nota
                ]
            );

        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find client for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    public function destroy($id)
    {
        try {

            $model = new NotaModel();
            $nota = $model->findNotaById($id);
            $model->delete($nota);

            return $this
                ->getResponse(
                    [
                        'message' => 'Client deleted successfully',
                    ]
                );

        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    function getData() {
        $authenticationHeader = $this->request->getServer('HTTP_AUTHORIZATION');

        try {            
            helper('jwt');
            $encodedToken = getJWTFromRequest($authenticationHeader);
            $user = dataJWTFromRequest($encodedToken);
            $this->ID = $user['id'];

        } catch (Exception $e) {

            $this->ID = 0;

        }
    }

}