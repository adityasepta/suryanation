public function listAktivitasMassal(){
        //Query mencari record berdasarkan ID
        $hasil = $this->db->query("SELECT * FROM aktivitas WHERE idAktivitas > 1003");
        if($hasil->num_rows() > 0){
            return $hasil->result();
        } else{
            return array();
        }
    }

    public function cekbom3() {
        $sql = "SELECT * from bommassal ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getBerat2() {

        $sql   = "SELECT f.idProProd, f.idSPK, f.idSubSPK, f.idWadah, f.idAktivitas, a.namaAktivitas , f.berat from factproduction2 f, aktivitas a where f.idaktivitas > 1005 and f.idAktivitas = a.idAktivitas order by f.idSPK, f.idSubSPK, f.idWadah, f.idAktivitas";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function getProsesDetail2($idProProd) {
        $sql   = "SELECT * from factproduction2 where idProProd = $idProProd";
        $query = $this->db->query($sql);
        
        return $query->result();   
    }

    public function getProsesDetail3($idWadah, $idAktivitas) {
        $sql   = "SELECT * from factproduction2 where idWadah = $idWadah and idAktivitas = $idAktivitas";
        $query = $this->db->query($sql);
        
        return $query->result();   
    }

    public function getIsiSPK($nomorFaktur) {
        $sql   = "SELECT idSPK, idSubSPK, bb.idWadah, cc.idAktivitas, namaAktivitas from (SELECT A.idSPK, B.idSubSPK, C.idWadah FROM spkmasal A LEFT JOIN subspk B ON A.idSPK = B.idSPK LEFT JOIN wadah C ON B.idSubSPK = C.idSubSPK where A.nomorFaktur = $nomorFaktur) aa, (select idWadah, max(idAktivitas) as idAktivitas from factproduction2 where idWadah != 0 group by idwadah) bb, (select idAktivitas, namaAktivitas from aktivitas ) cc where aa.idWadah = bb.idWadah and bb.idAktivitas = cc.idAktivitas";
        $query = $this->db->query($sql);
        
        return $query->result();   
    }

    public function getjadwal4($nomorFaktur) {
        $sql   = "SELECT *,DATE_FORMAT(r.startDate, '%d %M %Y' ) as sd, DATE_FORMAT(r.endDate, '%d %M %Y' ) as ed FROM aktivitas a, rencanaproduksi r, spkmasal s where s.idSPK = r.idSPK and a.idAktivitas = r.idAktivitas and s.nomorFaktur = '$nomorFaktur' order by r.idAktivitas";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function getBom2($nomorFaktur) {
        $sql   = "SELECT d.idSPK, c.idSubSPK, b.namaMaterial, b.stokMaterial as stok, a.jumlah as jml, b.safetyStock as ss, round((b.stokMaterial - a.jumlah),2) as stokakhir FROM bommassal a, materialdasar b, subspk c, spkmasal d where a.idMaterial = b.idMaterial and c.idSubSPK = a.idSubSPK and c.idSPK = d.idSPK and d.nomorFaktur = $nomorFaktur";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function getbom4($idSubSPK) {
        $sql = "SELECT * from bommassal a, materialdasar b where a.idSubSPK = $idSubSPK and a.idMaterial = b.idMaterial";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getProduk2($idProduk) {
        $sql    = "SELECT * from produk where idProduk = $idProduk";
        $query  = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function cekFinishSPK($nomorFaktur) {
        $sql   = "SELECT (SELECT count(*) as total FROM spkmasal A LEFT JOIN subspk B ON A.idSPK = B.idSPK LEFT JOIN wadah C ON B.idSubSPK = C.idSubSPK where A.nomorFaktur = $nomorFaktur) - (SELECT COUNT(*) FROM factproduction2 a, spkmasal b where a.idSPK = b.idSPK and a.idAktivitas = 1014 and a.statusWork = 'Done' and b.nomorFaktur = $nomorFaktur) as jml";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function getRecord2() {

        $sql   = "

            SELECT idSPK, idAktivitas, MAX(namaAktivitas) AS aktivitas, MAX( DATE_FORMAT(startDate, '%d %M %Y') ) AS sd, MAX( DATE_FORMAT(RealisasiStartDate, '%d %M %Y') ) AS rsd, MAX( DATE_FORMAT(endDate, '%d %M %Y') ) AS ed, MAX( DATE_FORMAT(RealisasiEndDate, '%d %M %Y') ) AS red, MAX(statusWork) AS stat, MAX(state) AS STATUS FROM ( SELECT r.idSPK, r.idAktivitas, a.namaAktivitas, r.startDate, f.RealisasiStartDate, r.endDate, f.RealisasiEndDate, f.statusWork, ( CASE WHEN( DATE_ADD(f.RealisasiEndDate, INTERVAL -1 DAY) <= r.endDate ) THEN 'On Time' ELSE 'Terlambat' END ) AS state FROM factproduction2 f JOIN rencanaproduksi r ON f.idSPK = r.idSPK AND f.idAktivitas = r.idAktivitas JOIN aktivitas a ON f.idAktivitas = a.idAktivitas UNION ALL SELECT r.idSPK, r.idAktivitas, a.namaAktivitas, r.startDate, '0000-00-00 00:00:00' AS RealisasiStartDate, r.endDate, '0000-00-00 00:00:00' AS RealisasiEndDate, '' AS statusWork, '' AS state FROM rencanaproduksi r JOIN aktivitas a ON r.idAktivitas = a.idAktivitas ) t where idAktivitas > 1003 GROUP BY idAktivitas, idSPK ORDER BY idspk, idaktivitas";
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    public function listInvoiceTempahan() {
        $hasil = $this->db->query("SELECT * FROM (SELECT a.idPO,a.nomorPO as noPurchaseOrder,a.tanggalMasuk,b.namaProduk,c.namaCustomer FROM potempahan a LEFT JOIN produk b ON a.idProduk = b.idProduk LEFT JOIN customer c ON a.idCustomer=c.idCustomer) a LEFT JOIN invoiceheader i ON a.noPurchaseOrder=i.nomorPO");
        if($hasil->num_rows() > 0){
            return $hasil->result();
        } else{
            return array();
        }
    }

    public function listInvoiceMassal() {
        $hasil = $this->db->query("SELECT * FROM (SELECT a.idPO,a.nomorPO as noPurchaseOrder,a.tanggalMasuk,b.namaProduk,c.namaCustomer FROM pomasal a LEFT JOIN produk b ON a.idProduk = b.idProduk LEFT JOIN customer c ON a.idCustomer=c.idCustomer) a LEFT JOIN invoiceheader i ON a.noPurchaseOrder=i.nomorPO");
        if($hasil->num_rows() > 0){
            return $hasil->result();
        } else{
            return array();
        }
    }

    public function getBeratMassal() {

        $sql   = "SELECT a.*,b.nama FROM (SELECT f.idProProd, f.idSPK, f.idSubSPK, f.idWadah, f.idAktivitas, a.namaAktivitas, SUM(f.berat) as berat, SUM(f.beratAwal) as beratAwal, SUM(f.kembali) as kembali, f.idPIC, f.statusBerat FROM factproduction2 f, aktivitas a WHERE f.idAktivitas = a.idAktivitas AND f.idAktivitas > 1002 GROUP BY idSPK,idAktivitas) a JOIN user b ON a.idPIC = b.idUser ORDER BY idSPK,idAktivitas";
        $query = $this->db->query($sql);
        
        /*SELECT a.*,b.nama FROM (SELECT f.idProProd, f.idSPK, f.idSubSPK, f.idWadah, f.idAktivitas, a.namaAktivitas, SUM(f.berat) as berat, SUM(f.beratAwal) as beratAwal, SUM(f.kembali) as kembali, f.idPIC, f.statusBerat FROM factproduction2 f, aktivitas a WHERE f.idAktivitas = a.idAktivitas AND f.idAktivitas > 1002 GROUP BY idSPK,idAktivitas) a JOIN user b ON a.idPIC = b.idUser ORDER BY idSPK,idAktivitas*/
        return $query->result();
    }

    public function getSPKMassal() {
        $sql    = "SELECT *, DATE_FORMAT (lastModified,'%d %M %Y') AS tglspk FROM spkmasal WHERE idSPK IN (select DISTINCT(idSPK) FROM rencanaproduksi2) ORDER BY lastModified DESC";
        $query  = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function rekapBeratMassal(){
        $sql= "SELECT * FROM `factproduction2` a JOIN aktivitas b JOIN spkmasal c on a.idAktivitas=b.idAktivitas AND a.idSPK=c.idSPK";
        $query=$this->db->query($sql);
        $result=$query->result();
        return $result;
    }

    public function cekjadwal2() {
        $sql   = "SELECT * from rencanaproduksi2";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function findSPKMassal($nomorFaktur){
        //Query mencari record berdasarkan ID
        $hasil = $this->db->query("SELECT * FROM spkmasal a LEFT JOIN produk b ON a.idProduk = b.idProduk LEFT JOIN customer c ON a.idCustomer=c.idCustomer LEFT JOIN pomasal d ON a.nomorPO = d.nomorPO LEFT JOIN user e ON d.idSalesPerson=e.idUser WHERE nomorFaktur=$nomorFaktur LIMIT 1");
        if($hasil->num_rows() > 0){
            return $hasil->result();
        } else{
            return array();
        }
    }

    public function getjadwal7($nomorFaktur) {
        $sql   = "SELECT *,DATE_FORMAT(r.startDate, '%d %M %Y' ) as sd, DATE_FORMAT(r.endDate, '%d %M %Y' ) as ed FROM aktivitas a, rencanaproduksi2 r, spkmasal s where s.idSPK = r.idSPK and a.idAktivitas = r.idAktivitas and s.nomorFaktur = '$nomorFaktur' order by r.idAktivitas";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    public function findSubSPK($idSubSPK){
        //Query mencari record berdasarkan ID
        $hasil = $this->db->query("SELECT * FROM subspk WHERE idSubSPK = '$idSubSPK' LIMIT 1");
        if($hasil->num_rows() > 0){
            return $hasil->result();
        } else{
            return array();
        }
    }