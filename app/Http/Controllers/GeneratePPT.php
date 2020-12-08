<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpPresentation\Autoloader;
use PhpOffice\PhpPresentation\Settings;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Slide;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\AbstractShape;
use PhpOffice\PhpPresentation\DocumentLayout;
use PhpOffice\PhpPresentation\Shape\Drawing;
use PhpOffice\PhpPresentation\Shape\RichText;
use PhpOffice\PhpPresentation\Shape\RichText\BreakElement;
use PhpOffice\PhpPresentation\Shape\RichText\TextElement;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Style\Bullet;
use PhpOffice\PhpPresentation\Style\Color;

class GeneratePPT extends Controller
{
    public function generateppt($id){
        $author = Http::withToken(config('services.tmdb.token'))
                            ->get('https://api.themoviedb.org/3/person/'.$id)
                            ->json();

        $credits = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits')
            ->json();

        $objPHPPowerPoint = new PhpPresentation();
        
        $currentSlide = $objPHPPowerPoint->getActiveSlide(); //retornando o slide ativo

        $shape = $currentSlide->createDrawingShape(); //criando uma forma de desenho (imagem)
        $shape->setName('Love Films') //definindo o nome da forma
            ->setDescription('Love Films') //definindo a descrição da forma
            ->setPath(public_path().'/logo.png') //definindo o  logo no topo do slide
            ->setHeight(36) //definindo a altura da forma
            ->setOffsetX(10) //definindo as coordenadas do eixo X referente a posição da forma
            ->setOffsetY(10); //definindo as coordenadas do eixo Y referente a posição da forma

        $shape->getShadow()->setVisible(true) //definindo uma sombra na imagem
                        ->setDirection(45) //definindo a direção da sombra
                        ->setDistance(10); //definindo a distancia da sombra

        $shape = $currentSlide->createRichTextShape() //criando uma forma (texto)
            ->setHeight(300) //definindo a altura da forma
            ->setWidth(600) //definindo a largura da forma
            ->setOffsetX(170) //definindo as coordenadas do eixo X referente a posição da forma
            ->setOffsetY(200); //definindo as coordenadas do eixo Y referente a posição da forma
        $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER ); //definindo o alinhamento do paragrafo
        $textRun = $shape->createTextRun($author['name'] .' - '. $author['birthday']); //definindo o texto a ser escrito
        $textRun->getFont()->setBold(true) //definindo a fonte como negrito
                        ->setSize(60) //definindo o tamanho da fonte
                        ->setColor( new Color( 'd41717' ) ); //definindo a cor da fonte


        
        foreach ($credits['cast'] as $key => $cast) {
            if($cast['media_type'] == 'tv'){
                $title = $cast['original_name'];
            
            }else if($cast['media_type'] == 'movie'){
                $title = $cast['original_title'];
            
            }
            $currentSlide = $objPHPPowerPoint->createSlide(); //criando um novo slide

            $shape = $currentSlide->createDrawingShape(); //criando uma forma de desenho (imagem)
            $shape->setName('Love Films') //definindo o nome da forma
                ->setDescription('Love Films') //definindo a descrição da forma
                ->setPath(public_path().'/logo.png') //definindo o  logo no topo do slide
                ->setHeight(36) //definindo a altura da forma
                ->setOffsetX(10) //definindo as coordenadas do eixo X referente a posição da forma
                ->setOffsetY(10); //definindo as coordenadas do eixo Y referente a posição da forma

            $shape->getShadow()->setVisible(true) //definindo uma sombra na imagem
                            ->setDirection(45) //definindo a direção da sombra
                            ->setDistance(10); //definindo a distancia da sombra

            
            $shape = $currentSlide->createRichTextShape() //criando uma forma (texto)
                ->setHeight(300) //definindo a altura da forma
                ->setWidth(600) //definindo a largura da forma
                ->setOffsetX(170) //definindo as coordenadas do eixo X referente a posição da forma
                ->setOffsetY(200); //definindo as coordenadas do eixo Y referente a posição da forma
            $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER ); //definindo o alinhamento do paragrafo
            $textRun = $shape->createTextRun($title); //definindo o texto a ser escrito
            $textRun->getFont()->setBold(true) //definindo a fonte como negrito
                            ->setSize(60) //definindo o tamanho da fonte
                            ->setColor( new Color( 'd41717' ) ); //definindo a cor da fonte
            $shape->getActiveParagraph()->createBreak();
            $textRun = $shape->getActiveParagraph()->createTextRun($cast['overview']); // N repeated textruns will be present;
        }

        $oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
        $oWriterPPTX->save(public_path()."/presentation.pptx");
        
        return response()->download(public_path('/sample.pptx'));

    }
}
