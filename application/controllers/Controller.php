public function listInvoiceTempahan() {
        $data['listPO'] = $this->mdl->listInvoiceTempahan();
        $this->load->view('user/listInvoiceTempahan',$data);
    }
   
    public function listInvoiceMassal() {
        $data['listPO'] = $this->mdl->listInvoiceMassal();
        $this->load->view('user/listInvoiceMassal',$data);
    }
    
    public function setPIC5()
    {
        
        $idp = $this->input->post('idProProd');
        
        $data = array(
            'idPIC' => $this->input->post('staf'),
            'statusWork' => 'On Progress',
            'RealisasiStartDate' => date("Y-m-d H:i:s"),
            'beratAwal' => $this->input->post('berat')
        );
        $this->mdl->updateData('idProProd', $idp, 'factproduction', $data);
        $this->session->set_flashdata('msg', '<div class="alert animated fadeInRight alert-success">Berhasil menambahkan PIC</div>');
        redirect('User/kanban');
        
    }

    //Inventory
    public function rekapBeratMassal() {
        $data['b'] = $this->mdl->getBeratMassal();
        $data['produk']=$this->mdl->getProd();  
        $data['spk']=$this->mdl->getSPKMassal();    
        $data['rekapBerat']=$this->mdl->rekapBeratMassal();
        $this->load->view('user/beratMassal',$data);
    }

    public function invoiceSPKMassal($nomorFaktur) {
        $data['dataSPK']   = $this->mdl->findSPKMasal($nomorFaktur);
        //$data['cekbom']    = $this->mdl->cekbom();
        //$data['cekjadwal'] = $this->mdl->cekjadwal();
        $data['jadwal']    = $this->mdl->getjadwal4($nomorFaktur);
        $data['stokbom']   = $this->mdl->getBom2($nomorFaktur);
        $data['isi'] = $this->mdl->getIsiSPK($nomorFaktur);
        $data['cf'] = $this->mdl->cekFinishSPK($nomorFaktur);
        $this->load->view('user/invoiceMassal', $data);
    }

    public function listSPKMasal()
    {
        $data['listSPK']   = $this->mdl->listSPKMasal();
        //$data['cekbom'] = $this->mdl->cekbom();
        $data['cekjadwal'] = $this->mdl->cekjadwal2();
        $data['klot']      = $this->mdl->getKloterSPK();
        $data['ceksub']    = $this->mdl->cekSubSPK();
        $data['cb']        = $this->mdl->cekbom2();
        $this->load->view('user/spkMasal', $data);
    }