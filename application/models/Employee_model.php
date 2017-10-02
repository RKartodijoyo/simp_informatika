<?php
/*
 * File Name: employee_model.php
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class employee_model extends CI_Model
{
    var $tabel = 'mahasiswa';
    function __construct()
    {
        // Call the Model construector
        parent::__construct();
    }
    function get_jurusan()
    {
        $this->db->select('id');
        $this->db->select('jurusan');
        $this->db->from('jurusan');
        $query  = $this->db->get();
        $result = $query->result();
        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id);
            array_push($dept_name, $result[$i]->jurusan);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }
    function get_hakakses()
    {
        $this->db->select('ID_HAKAKSES');
        $this->db->select('NAMA_HAKAKSES');
        $this->db->from('hakakses');
        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->ID_HAKAKSES);
            array_push($dept_name, $result[$i]->NAMA_HAKAKSES);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }
    function get_listpraktikum()
    {

        $this->db->select('id_praktikum');
        $this->db->select('nama_praktikum');

        $this->db->from('praktikum');
        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id_praktikum);
            array_push($dept_name, $result[$i]->nama_praktikum);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }
    function get_mahasiswa_from_nim($id)
    {

        $this->db->from('mahasiswa');
        $this->db->where('nim', $id);

        $query = $this->db->get();

        if ($query->num_rows() >= 1) {
            return $query->result();
        }

    }
    function get_list_dosen()
    {
        $this->db->select('id');
        $this->db->select('nama');

        $this->db->from('dospem');

        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id);
            array_push($dept_name, $result[$i]->nama);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }
    function get_list_praktikum()
    {
        $this->db->select('id_praktikum');
        $this->db->select('jenis_praktikum');
        $this->db->from('simp_praktikum');
        $query  = $this->db->get();
        $result = $query->result();
        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id_praktikum);
            array_push($dept_name, $result[$i]->jenis_praktikum);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }
    function get_set_tanggal_praktek()
    {

        $this->db->from('praktikumku');
        $this->db->where('status_pembayaran', '1');
        $this->db->where('tanggal_praktek', '0000-00-00');
        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_set_absen()
    {
        $this->db->from('praktikumku');
        $data = array(
            'status_pembayaran' => '1',
            'daftar_hadir' => '0'
        );
        $this->db->where($data);
        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_set_pengumpulanlaporan()
    {

        $this->db->from('praktikumku');
        $data = array(
            'status_pembayaran' => '1',
            'daftar_hadir' => '1',
            'bimbingan' => '1',
            'pengumpulan' => '0'
        );
        $this->db->where($data);
        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_allbarang4($id)
    {

        $this->db->from('praktikumku');
        $data = array(
            'status_pembayaran' => '1',
            'daftar_hadir' => '1',
            'nama_dopem' => $id,
            'bimbingan' => '0',
            'pengumpulan' => '0'
        );
        $this->db->where($data);
        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_dosen_bimbingan()
    {

        $this->db->from('praktikumku');
        $dataku = array(
            'nama_dopem' => $this->session->userdata('NIM_USER'),
            'bimbingan' => '0'
        );
        $this->db->where($dataku);
        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_verifikasi_pembayaran($id)
    {

        $this->db->from('praktikumku');
        $dataku = array(
            'nim' => $id,
            'status_pembayaran' => '0'
        );
        $this->db->where($dataku);
        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_aturjadwal($id)
    {

        $this->db->from('simp_praktikumku');
        $dataku = array(
            'kode_praktikum' => $id,
            'status_pembayaran' => '1',
            'tanggal_praktek' => '0',
            'daftar_hadir' => '0',
        );
        $this->db->where($dataku);
        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_belum_dapat_dospem()
    {

        $this->db->from('praktikumku');
        $this->db->where('status_pembayaran', '1');
        $this->db->where('nama_dopem', '0');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_belum_dapat_tanggal_praktek()
    {

        $this->db->from('praktikumku');
        $this->db->where('status_pembayaran', '1');
        $this->db->where('tanggal_praktek', '0000-00-00');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_user_exist($id)
    {
        $this->db->select('ni_user');


        $this->db->where($id);
        $this->db->from('simp_user');

        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->NIM_USER);
            array_push($dept_name, $result[$i]->NAMA_USER);
        }
        $department_result = array_combine($dept_id, $dept_name);


        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
    function get_praktikum_exist($id)
    {
        $this->db->select('id_praktikum');


        $this->db->where($id);
        $this->db->from('simp_praktikum');

        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id_praktikum);
            array_push($dept_name, $result[$i]->nama_praktikum);
        }
        $department_result = array_combine($dept_id, $dept_name);


        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
    function get_accounting_exist($id)
    {
        $this->db->select('no_account');


        $this->db->where($id);
        $this->db->from('accounting_debit_kredit');

        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id_accounting);
            array_push($dept_name, $result[$i]->kode_accounting);
        }
        $department_result = array_combine($dept_id, $dept_name);


        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
    function get_kelompok_exist($id)
    {
        $this->db->select('id_kelompok');


        $this->db->where($id);
        $this->db->from('simp_nama_kelompok');

        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id_kelompok);
            array_push($dept_name, $result[$i]->nama_kelompok);
        }
        $department_result = array_combine($dept_id, $dept_name);


        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
    function get_jampraktikum_exist($id)
    {
        $this->db->select('id_jam_praktikum');


        $this->db->where($id);
        $this->db->from('simp_jam_praktikum');

        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id_jam_praktikum);
            array_push($dept_name, $result[$i]->jam_praktikum);
        }
        $department_result = array_combine($dept_id, $dept_name);


        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
    function get_lab_exist($id)
    {
        $this->db->select('id_lab');


        $this->db->where($id);
        $this->db->from('simp_lab');

        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id_lab);
            array_push($dept_name, $result[$i]->nama_lab);
        }
        $department_result = array_combine($dept_id, $dept_name);


        if ($query->num_rows() >= 1) {
            return 1;
        } else {
            return 0;
        }
    }
    function get_allbarang($id)
    {
        $this->db->where('nim', $id);

        $this->db->from('praktikumku');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function nama_praktikum()
    {

        $this->db->from('praktikum');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function nama_mahasiswa1()
    {


        $this->db->from('mahasiswa');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function nama_mahasiswa2()
    {


        $this->db->from('mahasiswa');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function nama_dosenkuloh()
    {


        $this->db->from('dospem');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function dapat_dospem()
    {
        $this->db->from('praktikumku');
        $data = array(
            'status_pembayaran' => '1',
            'nama_dopem' => '0'
        );

        $this->db->where($data);
        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function del_barang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(praktikumku);
    }
    function del_praktikum($id)
    {
        $this->db->where('id_praktikum', $id);
        $this->db->delete(simp_praktikum);
    }
    function del_kelompok($id)
    {
        $this->db->where('id_praktikum', $id);
        $this->db->delete(simp_nama_kelompok);
    }
    function del_jam_praktikum($id)
    {
        $this->db->where('id_jam_praktikum', $id);
        $this->db->delete(simp_jam_praktikum);
    }
    function del_tanggal_praktikum($id)
    {
        $this->db->where('id_tanggal', $id);
        $this->db->delete(simp_tanggal);
    }
    function del_laboratorium($id)
    {
        $this->db->where('id_lab', $id);
        $this->db->delete(simp_lab);
    }
    function remove_checked_siswa()
    {
        $action = $this->input->post('action');
        if ($action > 0) {
            $delete = $this->input->post('msg');
            for ($i = 0; $i < count($delete); $i++) {
                $data = array(
                    'nama_dopem' => $action
                );

                //insert the form data into database

                $this->db->where('id', $delete[$i]);
                $this->db->update('praktikumku', $data);

            }
        }
    }
    function remove_checked_siswa1()
    {
        $action = $this->input->post('action');
        if ($action > 0) {
            $delete = $this->input->post('msg');
            for ($i = 0; $i < count($delete); $i++) {
                $data = array(
                    'tanggal_praktek' => $action
                );

                //insert the form data into database

                $this->db->where('id', $delete[$i]);
                $this->db->update('praktikumku', $data);

            }
        }
    }
    function ambildata()
    {
        $ambildata = $this->db->get('praktikumku');

        if ($ambildata->num_rows() > 0) {
            foreach ($ambildata->result() as $data) {
                $hasilsiswa[] = $data;
            }
            return $hasilsiswa;
        }
    }
    function nama_mahasiswa()
    {
        $this->db->from('mahasiswa');
        $this->db->where('nim', $this->session->userdata('NIM_USER'));

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_nim_count_accounting()
    {
        $this->db->from('accounting_debit_kredit');
        $this->db->where('ni', $this->session->userdata('NIM_USER'));

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function tambahpraktikum($ids)
    {
        $ids   = $ids;
        $count = 0;
        foreach ($ids as $id) {
            $did = intval($id) . '<br>';
            $this->db->where('id', $did);
            $this->db->delete('multi_del');
            $count = $count + 1;
        }

        echo '<div class="alert alert-success" style="margin-top:-17px;font-weight:bold">
            ' . $count . ' Item deleted successfully
            </div>';
        $count = 0;
    }
    function get_semester()
    {

        $this->db->select('id');
        $this->db->select('semester');
        $this->db->from('simp_semester');
        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id);
            array_push($dept_name, $result[$i]->semester);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }
    function get_keuangan()
    {

        $this->db->select('id_keuangan');
        $this->db->select('nama_keuangan');
        $this->db->from('simp_keuangan');
        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id_keuangan);
            array_push($dept_name, $result[$i]->nama_keuangan);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }
    function get_status()
    {

        $this->db->select('id');
        $this->db->select('nama_status');

        $this->db->from('status');
        $query  = $this->db->get();
        $result = $query->result();

        //array to store department id & department name
        $dept_id   = array(
            '-SELECT-'
        );
        $dept_name = array(
            '-SELECT-'
        );

        for ($i = 0; $i < count($result); $i++) {
            array_push($dept_id, $result[$i]->id);
            array_push($dept_name, $result[$i]->nama_status);
        }
        return $department_result = array_combine($dept_id, $dept_name);
    }
    function get_allpraktikum()
    {
        $this->db->from('simp_praktikum');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_allaccounting()
    {
        $this->db->from('accounting_debit_kredit');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_allkelompok()
    {
        $this->db->from('simp_nama_kelompok');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_alljampraktikum()
    {
        $this->db->from('simp_jam_praktikum');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
    function get_alllab()
    {
        $this->db->from('simp_lab');

        $query = $this->db->get();

        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }

    }
}

?>
