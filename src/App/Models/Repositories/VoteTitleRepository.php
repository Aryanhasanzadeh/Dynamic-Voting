<?php

namespace Aryanhasanzadeh\Voteing\App\Models\Repositories;

use Aryanhasanzadeh\Translator\App\Models\Repository\TranslateRepository;
use Aryanhasanzadeh\Voteing\App\Models\VoteTitle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class VoteTitleRepository { 

    private TranslateRepository $Translatorrepo;

    public function setTranslator()
    {
        $this->Translatorrepo = new TranslateRepository();
        return $this;
    }
    
    public function get(Request $request) : Collection
    {
        return VoteTitle::with('translate')->get();
    }

    public function create(array $array,bool $auto_update) : VoteTitle
    {
        $title = VoteTitle::create([
            'name' => !$auto_update ? $array['name'] : null,
            'status' => $array['status']
        ]);

        $this->doTranslate($array,$auto_update,$title);

        return $title;
    }
    
    public function update(VoteTitle $title,array $array,bool $auto_update) : VoteTitle
    {
        $title->update([
            'name' => !$auto_update ? $array['name'] : null,
            'status' => $array['status']
        ]);

        $this->doTranslate($array,$auto_update,$title);

        return $title;
    }


    public function delete(VoteTitle $title)
    {
        $title->delete();
    }


    private function doTranslate(array $array,bool $auto_update,VoteTitle $title)
    {
        if ($auto_update) {
            $this->Translatorrepo->setType(array_search('title',config('translator.types')))->setData($array['name'])->setParent($title)->setTranslator($auto_update)->manageUpdateOrInsert();
        }
    }
}