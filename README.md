# Antrian-Sidang
 Pemanggilan antrian sidang di Pengadilan Agama

## Instalasi
1. Pindahkan folder ini ke komputer server yang sama dengan folder SIPP.
2. Buat database dengan nama `antrian_sidang` di server yang sama dengan database SIPP.
3. Silahkan import file sql yang ada di folder ini.
4. Buka file `application/config/database.php` dan sesuaikan username, password dan databsenya.
`database.php'
```
$db['default'] = array(
    ...
    'username' => 'root',
	'password' => '',
	'database' => 'antrian_sidang',
    ...

$db['sipp'] = array(
    ...
    'username' => 'root',
	'password' => '',
	'database' => 'sipp',
    ...
```
5. Buka file `application/config/antrian_config.php` dan sesuaikan nama databasenya.
`antrian_config.php`
```
...
$config['database_sipp']='sipp';
$config['panggil']= 'luar'; // luar | pc
//luar = pc monitor yang berbunyi
//pc = pc ruang sidang yang berbunyi
...
```
6. Buka browser dan masukkan alamat `IP SERVER/antrian-sidang`.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)