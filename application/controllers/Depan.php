<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Depan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model('employee_model');
        $this->load->library('template');
        $this->template->set_navbar('templates/navbar1');
        $this->auth();
    }
    public function do_upload()
    {
        $config['upload_path']          = './gambar/';
        $config['allowed_types']        = 'gif|jpg|png|docs|docx|pdf';
        $this->load->library('upload', $config);
        if (! $this->upload->do_upload('userfile')) {
          $error = array('error' => $this->upload->display_errors());
          $this->load->view('depan/upload_form', $error);
        }
        else
        {
          $data = array('depan/upload_data' => $this->upload->data());
          $result = $this->upload->data();
          echo "<pre>";
          print_r($result);
          echo "</pre>";
        }
    }
    public function upload_form()
    {
          $this->load->view('depan/upload_form', array('error' => ' ' ));
    }
    private function auth()
    {
        if ($this->session->userdata('is_logged_in')) {
            return true;
        } else {
            redirect('user');
        }
    }
    /**
     * Load Page Index
     *
     * @return [type] [description]
     */
    public function index()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('footer');
    }
    /**
     * Get authentication
     *
     * @return [type] [description]
     */
    public function alpha_only_space($str)
    {
        if (!preg_match("/^([-a-z ])+$/i", $str)) {
            $this->form_validation->set_message('alpha_only_space', 'The %s field must contain only alphabets or spaces');
            return false;
        } else {
            return true;
        }
    }
    public function combo_check($str)
    {
        if ($str == '-SELECT-') {
            $this->form_validation->set_message('combo_check', 'Valid %s Name is required');
            return false;
        } else {
            return true;
        }
    }
    public function bimbingan()
    {
        $data['qbarang'] = $this->employee_model->get_dosen_bimbingan();
        //set validation rules
        //display success message
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/bimbingan', $data);
        $this->load->view('footer');
    }
    public function cetakpembayaran()
    {
        $nimku                 = $this->session->userdata('NIM_USER');
        $data['datapraktikum'] = $this->employee_model->get_verifikasi_pembayaran($nimku);
        $data['mahasiswa']     = $this->employee_model->nama_praktikum();
        $data['namanya']       = $this->employee_model->nama_mahasiswa();
        //set validation rules
        //display success message
        $this->load->view('depan/cetakpembayaran', $data);
    }
    public function cetakkartu()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/cetakkartu');
        $this->load->view('footer');
    }
    public function delete_multiple()
    {
        $this->load->model('employee_model');
        $this->employee_model->remove_checked_siswa1();
        redirect('depan/dosenpembimbing');
    }
    public function delete_multiple1()
    {
        $this->load->model('employee_model');
        $this->employee_model->remove_checked_siswa1();
        redirect('depan/pelaksanaanpraktikum');
    }
    public function del_all()
    {
        $ids = (explode(',', $this->input->get_post('id1')));
        $kau = $this->input->post('department');
        $this->home_model->delete($id1, $kau);
    }
    public function dosenbimbingan()
    {
        $data['department']       = $this->employee_model->get_list_dosen();
        $data['result']           = $this->employee_model->dapat_dospem();
        $data['namaku_praktikum'] = $this->employee_model->nama_praktikum();
        $data['namaku_mahasiswa'] = $this->employee_model->nama_mahasiswa2();
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/dosenbimbingan', $data);
        $this->load->view('footer');
    }
    public function dosenpembimbing()
    {
        $data['namaorang']        = $this->employee_model->nama_dosenkuloh();
        $data['department']       = $this->employee_model->get_list_dosen();
        $data['praktikum']        = $this->employee_model->nama_praktikum();
        $data['namaku_mahasiswa'] = $this->employee_model->nama_mahasiswa2();
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $data['hasilsiswa'] = $this->employee_model->get_belum_dapat_dospem();
        $this->load->view('depan/dosenpembimbing', $data);
        $this->load->view('footer');
    }
    public function hapus($gid)
    {
        $this->employee_model->del_barang($gid);
        redirect('depan/ubahpraktikum');
    }
    public function hapuspraktikum($gid)
    {
        $this->employee_model->del_praktikum($gid);
        redirect('depan/simp_formpraktikum');
    }
    public function hapuskelompok($gid)
    {
        $this->employee_model->del_kelompok($gid);
        redirect('depan/simp_formkelompok');
    }
    public function hapusjampraktikum($gid)
    {
        $this->employee_model->del_jam_praktikum($gid);
        redirect('depan/simp_jam_praktikum($gid)');
    }
    public function hapustanggalpraktikum($gid)
    {
        $this->employee_model->del_tanggal_praktikum($gid);
        redirect('depan/simp_jam_praktikum');
    }
    public function hapuslab($gid)
    {
        $this->employee_model->del_lab($gid);
        redirect('depan/simp_lab');
    }
    public function konfirmasipembayaran()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/konfirmasipembayaran');
        $this->load->view('footer');
    }
    public function lihatprofil()
    {
        $kampret         = $this->session->userdata('NIM_USER');
        $data['qbarang'] = $this->employee_model->get_department5($kampret);
        //set validation rules
        //insert the form data into database
        //display success message
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/lihatprofil', $data);
        $this->load->view('footer');
    }
    public function lihatpraktikum()
    {
        $data['namaku_praktikum'] = $this->employee_model->nama_praktikum();
        $data['namaku_dosen']     = $this->employee_model->nama_dosen();
        $id = $this->session->userdata('NIM_USER');
        $data['qbarang'] = $this->employee_model->get_allbarang($id);
        $data['test']    = $this->db->query("SELECT * FROM praktikumku");
        //set validation rules
        //insert the form data into database
        //display success message
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/lihatpraktikum', $data);
        $this->load->view('footer');
    }
    public function prosespraktikum()
    {
        $data['namaku_praktikum'] = $this->employee_model->nama_praktikum();
        $data['namaku_dosen']     = $this->employee_model->nama_dosen();
        $kampret         = $this->session->userdata('NIM_USER');
        $data['qbarang'] = $this->employee_model->get_allbarang($kampret);
        //set validation rules
        //insert the form data into database
        //display success message
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/prosespraktikum', $data);
        $this->load->view('footer');
    }
    public function pelaksanaanpraktikum()
    {
        $data['namaorang']        = $this->employee_model->nama_dosenkuloh();
        $data['department']       = $this->employee_model->get_list_dosen();
        $data['namaku_mahasiswa'] = $this->employee_model->nama_mahasiswa2();
        $data['praktikum']        = $this->employee_model->nama_praktikum();
        $data['qbarang']          = $this->employee_model->get_belum_dapat_tanggal_praktek();
        $this->form_validation->set_rules('hireddate', 'Hired Date', 'required');
        //set validation rules
        //display success message
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/pelaksanaanpraktikum', $data);
        $this->load->view('footer');
    }
    public function questioner_mahasiswa()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/questioner_mahasiswa');
        $this->load->view('footer');
    }
    public function simp_tambahpraktikan()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $this->form_validation->set_rules('nim', 'No Nim', 'trim|required|numeric');
        $this->form_validation->set_rules('nama', 'Nama user', 'trim|required|xss_clean|callback_alpha_only_space');
        $this->form_validation->set_rules('password', 'Password User', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_tambahpraktikan');
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"></div>');
            $this->load->view('footer');
        } else {
            //pass validation
            $data  = array(
                'ni_user' => $this->input->post('nim'),
                'nama_user' => $this->input->post('nama'),
                'katasandi_user' => @md5($this->input->post('password')),
                'tgldaftar_user' => @date('Y-m-d'),
                'hakakses_user' => 1,
                'status_user' => 1
            );
            $data1 = array(
                'ni_user' => $this->input->post('nim')
            );
            if ($this->employee_model->get_user_exist($data1)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_tambahpraktikan');
                $this->load->view('footer');
            } else {
                //insert the form data into database
                $this->db->insert('simp_user', $data);
                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_tambahpraktikan');
                $this->load->view('footer');
            }
        }
    }
    public function simp_tambahadministrator()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $this->form_validation->set_rules('kl', 'Kode Login', 'trim|required|numeric');
        $this->form_validation->set_rules('nama', 'Nama user', 'trim|required|xss_clean|callback_alpha_only_space');
        $this->form_validation->set_rules('password', 'Password User', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_tambahadministrator');
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"></div>');
            $this->load->view('footer');
        } else {
            //pass validation
            $data  = array(
                'ni_user' => $this->input->post('kl'),
                'nama_user' => $this->input->post('nama'),
                'katasandi_user' => @md5($this->input->post('password')),
                'tgldaftar_user' => @date('Y-m-d'),
                'hakakses_user' => 3,
                'status_user' => 1
            );
            $data1 = array(
                'ni_user' => $this->input->post('kl')
            );
            if ($this->employee_model->get_user_exist($data1)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_tambahadministrator');
                $this->load->view('footer');
            } else {
                //insert the form data into database
                $this->db->insert('simp_user', $data);
                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_tambahadministrator');
                $this->load->view('footer');
            }
        }
    }
    public function simp_tambahdosen()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $this->form_validation->set_rules('nid', 'No Nim', 'trim|required|numeric');
        $this->form_validation->set_rules('dosenid', 'No Dosen', 'trim|required|numeric');
        $this->form_validation->set_rules('nama', 'Nama user', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password User', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_tambahdosen');
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"></div>');
            $this->load->view('footer');
        } else {
            //pass validation
            $data  = array(
                'ni_user' => $this->input->post('nid'),
                'nama_user' => $this->input->post('nama'),
                'katasandi_user' => @md5($this->input->post('password')),
                'jikadosenid_user' => $this->input->post('dosenid'),
                'tgldaftar_user' => @date('Y-m-d'),
                'hakakses_user' => 2,
                'status_user' => 1
            );
            $data1 = array(
                'ni_user' => $this->input->post('nid')
            );

            $data2 = array(
                'jikadosenid_user' => $this->input->post('dosenid')
            );
            if ($this->employee_model->get_user_exist($data1) || $this->employee_model->get_user_exist($data2)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_tambahdosen');
                $this->load->view('footer');
            } else {
                //insert the form data into database
                $this->db->insert('simp_user', $data);
                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_tambahdosen');
                $this->load->view('footer');
            }
        }
    }
    public function simp_tambahassisten()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $this->form_validation->set_rules('nia', 'No NIA', 'trim|required|numeric');
        $this->form_validation->set_rules('assisten', 'No Assisten', 'trim|required|numeric');
        $this->form_validation->set_rules('nama', 'Nama user', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password User', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_tambahassisten');
            $this->load->view('footer');
        } else {
            //pass validation
            $data  = array(
                'ni_user' => $this->input->post('nia'),
                'nama_user' => $this->input->post('nama'),
                'katasandi_user' => @md5($this->input->post('password')),
                'jikaasstid    ' => $this->input->post('assisten'),
                'tgldaftar_user' => @date('Y-m-d'),
                'hakakses_user' => 4,
                'status_user' => 1
            );
            $data1 = array(
                'ni_user' => $this->input->post('nia')
            );
            $data2 = array(
                'jikadosenid_user' => $this->input->post('assisten')
            );
            if ($this->employee_model->get_user_exist($data1) || $this->employee_model->get_user_exist($data2)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_assisten');
                $this->load->view('footer');
            } else {
                //insert the form data into database
                $this->db->insert('simp_user', $data);
                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_assisten');
                $this->load->view('footer');
            }
        }
    }
    public function simp_formpraktikum()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $data['qbarang']    = $this->employee_model->get_allpraktikum();
        $data['department'] = $this->employee_model->get_semester();
        //    $data['deprtment'] = $this->employee_model->get_semester();
        $this->form_validation->set_rules('department', 'Department', 'callback_combo_check');
        $this->form_validation->set_rules('idpraktikum', 'No', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('kodepraktikum', 'Kode Praktikum', 'trim|required|xss_clean');
        $this->form_validation->set_rules('namapraktikum', 'Nama Praktikum', 'trim|required|xss_clean');
        $this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|xss_clean|numeric');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_formpraktikum', $data);
            $this->load->view('footer');
        } else {
            if ($this->input->post(btn_upt)) {
                $data1 = array(
                    'id_praktikum' => $this->input->post('idpraktikum')
                );
                if ($this->employee_model->get_praktikum_exist($data1)) {
                    $data = array(
                        'kode_praktikum' => $this->input->post('kodepraktikum'),
                        'jenis_praktikum' => $this->input->post('namapraktikum'),
                        'semester' => $this->input->post('semester'),
                        'biaya' => $this->input->post('biaya')
                    );
                    //insert the form data into database
                    $this->db->where('id_praktikum', $this->input->post('idpraktikum'));
                    $this->db->update('simp_praktikum', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Update!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');

                    redirect('depan/simp_formpraktikum');
                    $this->load->view('footer');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Praktikum belum ada</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formpraktikum');
                    $this->load->view('footer');
                }
            } else {
                //pass validation
                $data  = array(
                    'id_praktikum' => $this->input->post('idpraktikum'),
                    'kode_praktikum' => $this->input->post('kodepraktikum'),
                    'jenis_praktikum' => $this->input->post('namapraktikum'),
                    'semester' => $this->input->post('semester'),
                    'biaya' => $this->input->post('biaya')
                );
                $data1 = array(
                    'id_praktikum' => $this->input->post('id_praktikum')
                );
                if ($this->employee_model->get_praktikum_exist($data1)) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formpraktikum');
                    $this->load->view('footer');
                } else {
                    //insert the form data into database
                    $this->db->insert('simp_praktikum', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formpraktikum');
                    $this->load->view('footer');
                }
            }
        }
    }
    public function simp_formaccounting()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $bapa               = 1;
        $counting           = $this->employee_model->get_nim_count_accounting();
        $getsaldo           = $this->employee_model->get_allaccounting();
        $data['qbarang']    = $this->employee_model->get_allaccounting();
        $data['department'] = $this->employee_model->get_keuangan();
        $this->form_validation->set_rules('noaccounting', 'No Account', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('nokwitansi', 'No Kwintansi', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('department', 'Department', 'callback_combo_check');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required|xss_clean|numeric');
        if (empty($counting)) {
        } else {
            foreach ($counting as $pace) {
                $bapa++;
            }
        }
        if (empty($getsaldo)) {
        } else {
            $cokersaldo  = 0;
            $cokerdebit  = 0;
            $cokerkredit = 0;
            foreach ($getsaldo as $coker) {
                $cokerdebit  = 0;
                $cokerkredit = 0;
                if ($coker->tipe == 1) {
                    $cokerdebit = $coker->jumlah;
                } else {
                    $cokerkredit = $coker->jumlah;
                }
                if ($cokerdebit > 0) {
                    $cokersaldo += $cokerdebit;
                } else {
                    $cokersaldo -= $cokerkredit;
                }
            }
        }
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_formaccounting', $data);
            $this->load->view('footer');
        } else {
            if ($this->input->post(btn_upt)) {
                $data1 = array(
                    'no_account' => $this->input->post('noaccounting')
                );
                if ($this->employee_model->get_accounting_exist($data1)) {
                    $data = array(
                        'no_kwitansi' => $this->input->post('nokwitansi'),
                        'keterangan' => $this->input->post('keterangan'),
                        'jumlah' => $this->input->post('jumlah')
                    );
                    //insert the form data into database
                    $this->db->where('no_account', 1);
                    $this->db->update('accounting_debit_kredit', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Update!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formaccounting');
                    $this->load->view('footer');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Praktikum belum ada</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formaccounting');
                    $this->load->view('footer');
                }
            } else {
                if ($this->input->post('department') == 2 && $this->input->post('jumlah') > $cokersaldo) {
                    //fail validation
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Saldo tidak bisa minus</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formaccounting');
                    $this->load->view('footer');
                } else {
                    $kodeaccounting = "kode" . $this->session->userdata('NIM_USER') . $bapa . @date('Y');
                    //pass validation
                    $data           = array(
                        'kode_accounting' => $kodeaccounting,
                        'no_account' => $this->input->post('noaccounting'),
                        'no_kwitansi' => $this->input->post('nokwitansi'),
                        'tanggal' => @date('Y-m-d'),
                        'keterangan' => $this->input->post('keterangan'),
                        'tipe' => $this->input->post('department'),
                        'jumlah' => $this->input->post('jumlah'),
                        'ni' => $this->session->userdata('NIM_USER')
                    );
                    $data1          = array(
                        'no_account' => $this->input->post('noaccounting')
                    );
                    if ($this->employee_model->get_accounting_exist($data1)) {
                        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                        $this->load->view('header');
                        $this->load->view('templates/navbar1');
                        redirect('depan/simp_formaccounting');
                        $this->load->view('footer');
                    } else {
                        //insert the form data into database
                        $this->db->insert('accounting_debit_kredit', $data);
                        //display success message
                        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                        $this->load->view('header');
                        $this->load->view('templates/navbar1');
                        redirect('depan/simp_formaccounting');
                        $this->load->view('footer');
                    }
                }
            }
        }
    }
    public function simp_formkelompok()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $data['qbarang'] = $this->employee_model->get_allkelompok();
        //    $data['deprtment'] = $this->employee_model->get_semester();
        $this->form_validation->set_rules('idkelompok', 'No', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('namakelompok', 'Kode Praktikum', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_formkelompok', $data);
            $this->load->view('footer');
        } else {
            if ($this->input->post(btn_upt)) {
                $data1 = array(
                    'id_kelompok' => $this->input->post('idkelompok')
                );
                if ($this->employee_model->get_kelompok_exist($data1)) {
                    $data = array(
                        'nama_kelompok' => $this->input->post('namakelompok')
                    );
                    //insert the form data into database
                    $this->db->where('id_kelompok', $this->input->post('idkelompok'));
                    $this->db->update('simp_nama_kelompok', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Update!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formkelompok');
                    $this->load->view('footer');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Praktikum belum ada</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formkelompok');
                    $this->load->view('footer');
                }
            } else {
                //pass validation
                $data  = array(
                    'id_kelompok' => $this->input->post('idkelompok'),
                    'nama_kelompok' => $this->input->post('namakelompok')
                );
                $data1 = array(
                    'id_kelompok' => $this->input->post('idkelompok')
                );
                if ($this->employee_model->get_kelompok_exist($data1)) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formkelompok');
                    $this->load->view('footer');
                } else {
                    //insert the form data into database
                    $this->db->insert('simp_nama_kelompok', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formkelompok');
                    $this->load->view('footer');
                }
            }
        }
    }
    public function simp_formjampraktikum()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $data['qbarang'] = $this->employee_model->get_alljampraktikum();
        //    $data['deprtment'] = $this->employee_model->get_semester();
        $this->form_validation->set_rules('idjampraktikum', 'No', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('jampraktikum', 'Jam Praktikum', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_formjampraktikum', $data);
            $this->load->view('footer');
        } elseif ($this->form_validation->run() == update) {
            $data1 = array(
                'id_jam_praktikum' => $this->input->post('idjampraktikum')
            );
            if ($this->employee_model->get_kelompok_exist($data1)) {
                $data = array(
                    'jam_praktikum' => $this->input->post('jampraktikum')
                );
                //insert the form data into database
                $this->db->where('id_jam_praktikum', $this->input->post('idjampraktikum'));
                $this->db->update('simp_jam_praktikum', $data);
                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Update!!!</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_formjampraktikum');
                $this->load->view('footer');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Praktikum belum ada</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_formjampraktikum');
                $this->load->view('footer');
            }
        } else {
            //pass validation
            $data  = array(
                'id_jam_praktikum' => $this->input->post('idjampraktikum'),
                'jam_praktikum' => $this->input->post('jampraktikum')
            );
            $data1 = array(
                'id_jam_praktikum' => $this->input->post('idjampraktikum')
            );
            if ($this->employee_model->get_jampraktikum_exist($data1)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_formjampraktikum');
                $this->load->view('footer');
            } else {
                //insert the form data into database
                $this->db->insert('simp_jam_praktikum', $data);
                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/simp_formjampraktikum');
                $this->load->view('footer');
            }
        }
    }
    public function simp_formlab()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $data['qbarang'] = $this->employee_model->get_alllab();
        $this->form_validation->set_rules('idlab', 'No', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('namalab', 'Nama Lab', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_formlab', $data);
            $this->load->view('footer');
        } else {
            if ($this->input->post(btn_upt)) {
                $data1 = array(
                    'id_lab' => $this->input->post('idlab')
                );
                if ($this->employee_model->get_kelompok_exist($data1)) {
                    $data = array(
                        'nama_lab' => $this->input->post('namalab')
                    );
                    //insert the form data into database
                    $this->db->where('id_lab', $this->input->post('idlab'));
                    $this->db->update('simp_lab', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Update!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formlab');
                    $this->load->view('footer');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Praktikum belum ada</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formlab');
                    $this->load->view('footer');
                }
            } else {
                //pass validation
                $data  = array(
                    'id_lab' => $this->input->post('idlab'),
                    'nama_lab' => $this->input->post('namalab')
                );
                $data1 = array(
                    'id_lab' => $this->input->post('idlab')
                );
                if ($this->employee_model->get_namalab_exist($data1)) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formlab');
                    $this->load->view('footer');
                } else {
                    //insert the form data into database
                    $this->db->insert('simp_lab', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formlab');
                    $this->load->view('footer');
                }
            }
        }
    }
    public function simp_formjadwalpraktikum()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $data['qbarang'] = $this->employee_model->get_allpraktikum();
        $this->load->view('depan/simp_formjadwalpraktikum', $data);
        $this->load->view('footer');
    }
    public function simp_formjadwalpraktikumke2($cur)
    {
        if(empty($cur)) {
            $cur=0;
        }
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $data['qbarang'] = $this->employee_model->get_aturjadwal($cur);
        $this->form_validation->set_rules('idlab', 'No', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('namalab', 'Nama Lab', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_formjadwalpraktikumke2', $data);
            $this->load->view('footer');
        } else {
            if ($this->input->post(btn_upt)) {
                $data1 = array(
                    'id_lab' => $this->input->post('idlab')
                );
                if ($this->employee_model->get_kelompok_exist($data1)) {
                    $data = array(
                        'nama_lab' => $this->input->post('namalab')
                    );
                    //insert the form data into database
                    $this->db->where('id_lab', $this->input->post('idlab'));
                    $this->db->update('simp_lab', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Update!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formjadwalpraktikumke2');
                    $this->load->view('footer');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Praktikum belum ada</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formjadwalpraktikumke2');
                    $this->load->view('footer');
                }
            } else {
                //pass validation
                $data  = array(
                    'id_lab' => $this->input->post('idlab'),
                    'nama_lab' => $this->input->post('namalab')
                );
                $data1 = array(
                    'id_lab' => $this->input->post('idlab')
                );
                if ($this->employee_model->get_namalab_exist($data1)) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formjadwalpraktikumke2');
                    $this->load->view('footer');
                } else {
                    //insert the form data into database
                    $this->db->insert('simp_lab', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formjadwalpraktikumke2');
                    $this->load->view('footer');
                }
            }
        }
    }
    public function simp_formtambahtanggal()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $data['department'] = $this->employee_model->get_list_praktikum();
        $this->form_validation->set_rules('department', 'Department', 'callback_combo_check');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/simp_formtambahtanggal', $data);
            $this->load->view('footer');
        } else {
            if ($this->input->post(btn_upt)) {
                $data1 = array(
                    'id_lab' => $this->input->post('idlab')
                );
                if ($this->employee_model->get_kelompok_exist($data1)) {
                    $data = array(
                        'nama_lab' => $this->input->post('namalab')
                    );
                    //insert the form data into database
                    $this->db->where('id_lab', $this->input->post('idlab'));
                    $this->db->update('simp_lab', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Update!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formtambahtanggal');
                    $this->load->view('footer');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Praktikum belum ada</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formlab');
                    $this->load->view('footer');
                }
            } else {
                //pass validation
                $data  = array(
                    'id_lab' => $this->input->post('idlab'),
                    'nama_lab' => $this->input->post('namalab')
                );
                $data1 = array(
                    'id_lab' => $this->input->post('idlab')
                );
                if ($this->employee_model->get_namalab_exist($data1)) {
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formtambahtanggal');
                    $this->load->view('footer');
                } else {
                    //insert the form data into database
                    $this->db->insert('simp_tanggal', $data);
                    //display success message
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                    $this->load->view('header');
                    $this->load->view('templates/navbar1');
                    redirect('depan/simp_formtambahtanggal');
                    $this->load->view('footer');
                }
            }
        }
    }
    public function tambahuser()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $data['department']  = $this->employee_model->get_hakakses();
        $data['department1'] = $this->employee_model->get_department3();
        //set validation rules
        $this->form_validation->set_rules('employeeno', 'Employee No', 'trim|required|numeric');
        $this->form_validation->set_rules('employeename', 'Employee Name', 'trim|required|xss_clean|callback_alpha_only_space');
        $this->form_validation->set_rules('employeename1', 'Employee Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('employeename2', 'Employee Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('department', 'Department', 'callback_combo_check');
        $this->form_validation->set_rules('department1', 'Department', 'callback_combo_check');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/tambahuser', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"></div>');
            $this->load->view('footer');
        } else {
            //pass validation
            $data  = array(
                'NIM_USER' => $this->input->post('employeeno'),
                'NAMA_USER' => $this->input->post('employeename'),
                'KATASANDI_USER' => @md5($this->input->post('employeename1')),
                'EMAIL_USER' => $this->input->post('employeename2'),
                'TGLDAFTAR_USER' => @date('Y-m-d'),
                'HAKAKSES_USER' => $this->input->post('department')
                //    'STATUS_USER' => $this->input->post('department1'),
            );
            $data1 = array(
                'NIM_USER' => $this->input->post('employeeno'),
                'NAMA_USER' => $this->input->post('employeename')
            );
            if ($this->employee_model->get_department8($data1)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> sudah ada data</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/tambahuser');
                $this->load->view('footer');
            } else {
                //insert the form data into database
                $this->db->insert('user', $data);
                if ($this->input->post('department') == 1) {
                    $this->db->insert('mahasiswa', $data1);
                }
                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/tambahuser');
                $this->load->view('footer');
            }
        }
    }

    public function tambahberita()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //plugin ckeditor di defenisikan pada halaman index

        $data['department'] = $this->employee_model->get_hakakses();
        //set validation rules
        $this->form_validation->set_rules('employeename', 'Employee Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('employeename1', 'Employee Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/tambahberita', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"></div>');
            $this->load->view('footer');
        } else {
            //pass validation
            $data = array(
                'JUDUL_BERITA' => $this->input->post('employeename'),
                'ISI_BERITA' => $this->input->post('employeename1'),
                'TANGGAL_BERITA    ' => @date('Y-m-d')
            );
            //insert the form data into database
            $this->db->insert('berita', $data);
            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
            $this->load->view('header');
            $this->load->view('templates/navbar1');
            redirect('depan/tambahberita');
            $this->load->view('footer');
        }
    }
    public function uploaddoc()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //plugin ckeditor di defenisikan pada halaman index

        $this->load->view('depan/uploaddoc', array('error' => ' ' ));
        $this->load->view('footer');
        //set validation rules

    }
    public function tambahpraktikum()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $data['department'] = $this->employee_model->get_listpraktikum();
        //set validation rules
        $this->form_validation->set_rules('department', 'Department', 'callback_combo_check');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/tambahpraktikum', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"></div>');
            $this->load->view('footer');
        } else {
            //pass validation
            $data = array(
                'nim' => $this->session->userdata('NIM_USER'),
                'kode_praktikum' => $this->input->post('department')
            );
            // Produces: WHERE name = 'Joe' AND title = 'boss' AND status = 'active'
            if ($this->employee_model->get_department6($data)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> </div>');
                $this->load->view('header');
                $this->load->view('templates/navbar1');
                redirect('depan/tambahpraktikum');
                $this->load->view('footer');
            } else {
                //insert the form data into database
                $this->db->insert('praktikumku', $data);
                //display success message
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
                $this->load->view('header');
                echo $status;
                $this->load->view('templates/navbar1');
                redirect('depan/tambahpraktikum');
                $this->load->view('footer');
            }
        }
    }
    public function tanyamahasiswa()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/tanyamahasiswa');
        $this->load->view('footer');
    }
    public function ubahpraktikum()
    {
        $data['namaku_praktikum'] = $this->employee_model->nama_praktikum();
        $data['namaku_dosen']     = $this->employee_model->nama_dosenkuloh();
        $id = $this->session->userdata('NIM_USER');
        $data['qbarang'] = $this->employee_model->get_allbarang($id);
        //set validation rules
        //display success message
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/ubahpraktikum', $data);
        $this->load->view('footer');
    }
    public function ubahprofil()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $data['department'] = $this->employee_model->get_jurusan();
        //set validation rules
        $this->form_validation->set_rules('employeename', 'Employee Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('department', 'Department', 'callback_combo_check');
        $this->form_validation->set_rules('employeename1', 'Employee Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('salary', 'Salary', 'required|numeric');
        $this->form_validation->set_rules('employeename2', 'Employee Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/ubahprofil', $data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"></div>');
            $this->load->view('footer');
        } else {
            //pass validation
            $data1 = array(
                'NAMA_USER' => $this->input->post('employeename')
            );
            $data  = array(
                'nama' => $this->input->post('employeename'),
                'jurusan' => $this->input->post('department'),
                'alamat' => $this->input->post('employeename1'),
                'nohp' => $this->input->post('salary'),
                'email' => $this->input->post('employeename2')
            );
            //insert the form data into database
            $this->db->where('nim', $this->session->userdata('NIM_USER'));
            $this->db->update('mahasiswa', $data);
            $this->db->where('NIM_USER', $this->session->userdata('NIM_USER'));
            $this->db->update('user', $data1);
            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
            $this->load->view('header');
            $this->load->view('templates/navbar1');
            redirect('depan/ubahprofil');
            $this->load->view('footer');
        }
    }
    public function ubahpassmahasiswa()
    {
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        //set validation rules
        $this->form_validation->set_rules('employeename', 'Employee Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            //fail validation
            $this->load->view('depan/ubahpassmahasiswa');
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"></div>');
            $this->load->view('footer');
        } else {
            //pass validation
            $data1 = array(
                'KATASANDI_USER' => @md5($this->input->post('employeename'))
            );
            //insert the form data into database
            $this->db->where('NIM_USER', $this->session->userdata('NIM_USER'));
            $this->db->update('user', $data1);
            $this->db->where('NIM_USER', $this->session->userdata('NIM_USER'));
            $this->db->update('user', $data1);
            //display success message
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
            $this->load->view('header');
            $this->load->view('templates/navbar1');
            redirect('depan/ubahpassmahasiswa');
            $this->load->view('footer');
        }
    }
    public function verpembayaran($id)
    {
        $gatel  = strpos($id, 'i');
        $gatel1 = strlen($id);
        $id1    = substr($id, $gatel + 1);
        $id2    = substr($id, 0, -($gatel1 - $gatel));
        $dataku = array(
            'nim' => $id1,
            'kode_praktikum' => $id2
        );
        $this->db->where($dataku);
        $data1 = array(
            'status_pembayaran' => 1
        );
        $this->db->update('praktikumku', $data1);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> nama berhasil di update</div>");
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        redirect('depan/verifikasipembayaran');
        $this->load->view('footer');
    }
    public function verpengumpulan($id)
    {
        $gatel  = strpos($id, 'i');
        $gatel1 = strlen($id);
        $id1    = substr($id, $gatel + 1);
        $id2    = substr($id, 0, -($gatel1 - $gatel));
        $dataku = array(
            'nim' => $id1,
            'kode_praktikum' => $id2
        );
        $this->db->where($dataku);
        $data1 = array(
            'pengumpulan' => 1
        );
        $this->db->update('praktikumku', $data1);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> nama berhasil di update</div>");
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        redirect('depan/verifikasipengumpulan');
        $this->load->view('footer');
    }
    public function verkehadiran($id)
    {
        $gatel  = strpos($id, 'i');
        $gatel1 = strlen($id);
        $id1    = substr($id, $gatel + 1);
        $id2    = substr($id, 0, -($gatel1 - $gatel));
        $dataku = array(
            'nim' => $id1,
            'kode_praktikum' => $id2
        );
        $this->db->where($dataku);
        $data1 = array(
            'daftar_hadir' => 1
        );
        $this->db->update('praktikumku', $data1);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> nama berhasil di update</div>");
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        redirect('depan/verifikasikehadiran');
        $this->load->view('footer');
    }
    public function verbimbingan($id)
    {
        $gatel  = strpos($id, 'i');
        $gatel1 = strlen($id);
        $id1    = substr($id, $gatel + 1);
        $id2    = substr($id, 0, -($gatel1 - $gatel));
        $dataku = array(
            'nim' => $id1,
            'kode_praktikum' => $id2,
            'nama_dopem' => $this->session->userdata('NIM_USER')
        );
        $this->db->where($dataku);
        $data1 = array(
            'status_pembayaran' => 1
        );
        $this->db->update('praktikumku', $data1);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"glyphicon glyphicon-ok\"></i> nama berhasil di update</div>");
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        redirect('depan/bimbingan');
        $this->load->view('footer');
    }
    public function verifikasikehadiran()
    {
        $data['qbarang']   = $this->employee_model->get_set_absen();
        $data['praktikum'] = $this->employee_model->nama_praktikum();
        //set validation rules
        //display success message
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/verifikasikehadiran', $data);
        $this->load->view('footer');
    }
    public function verifikasipengumpulan()
    {
        $data['praktikum'] = $this->employee_model->nama_praktikum();
        $data['qbarang'] = $this->employee_model->get_set_pengumpulanlaporan();
        //set validation rules
        //display success message
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/verifikasipengumpulan', $data);
        $this->load->view('footer');
    }
    public function verifikasipembayaran()
    {
        $data['praktikum'] = $this->employee_model->nama_praktikum();
        $data['qbarang']   = $this->employee_model->get_set_tanggal_praktek();
        //set validation rules
        //display success message
        $this->load->view('header');
        $this->load->view('templates/navbar1');
        $this->load->view('depan/verifikasipembayaran', $data);
        $this->load->view('footer');
    }
}
