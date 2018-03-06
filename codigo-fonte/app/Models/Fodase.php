<?php
namespace App\Models;

use App\Models\ModelControl;

/**
 * Class Fodase
 * @package App\Models
 * @author Thiago Farias <thiago.amarante.farias@gmail.com>
 * @version 06/03/2018
 */
class Fodase extends ModelControl {
    
    
    protected $primaryKey = 'id';
    
    public $table = 'fodase';
    public $timestamps = false;

    public static $carros = [
        '1' => 'Corsa',
        '2' => 'Fuca',
        '3' => 'Gol',
    ];
    
    /**
     * Variaveis seguras para uso e guardar dados 
     * @var array 
     */
    public $fillable = [
        'id',
        'nome',
        'carro',
        'teste',
    ];
    
    /**
     * Tipos nativos dos atributos
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'carro' => 'string',
        'teste' => 'string',
    ];    
    
    /**
     * Label dos atributos
     * @var array 
     */
    public $labels = [
        'id' => 'ID',
        'nome' => 'Nome',
        'carro' => 'Carro',
        'teste' => 'Teste',
    ];
    


    
    /**
     * Realiza a consulta da tabela
     *
     * @param array $filter
     * @return \Illuminate\Support\Collection
     */
    public function consultar(array $filter = [], $expression = '*') {
        
        if(empty($filter)) {
            $filter = $this->toArray();
        }
        
        $builder = self::selectRaw($expression);

 
        
                    
        if($this->id) {
            $builder->where('id', $this->id);
        }
        
 
        
        if($this->nome) {
            $builder->where('nome', 'like', '%'.$this->nome.'%');
        }
        
 
        
                    
        if($this->carro) {
            $builder->where('carro', $this->carro);
        }
        
 
        
                    
        if($this->teste) {
            $builder->where('teste', $this->teste);
        }
        
        

        $builder->orderBy('id', 'DESC');

        return $builder->get();
    }
}