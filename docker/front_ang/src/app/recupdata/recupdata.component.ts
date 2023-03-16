import { Component, OnInit } from '@angular/core';
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-recupdata',
  templateUrl: './recupdata.component.html',
  styleUrls: ['./recupdata.component.css']
})

@Injectable()
export class RecupdataComponent implements OnInit {

constructor(private http: HttpClient){}
 valueRetour: any;

 //methode appelée à chaque appel du composant
 ngAfterViewInit(){
   this.doGET();
 }

 // methode réalisant l'appel au web service et insérant la réponse
 // dans une variable définie avant
 doGET() {

   console.log("GET");
   let url = `http://prjsymf.cir3-frm-smf-ang-35/api/listecle`;
   //this.http.get(url).subscribe(res => console.log(res.json()));
   this.http.get<any[]>(url).subscribe((response) => {this.valueRetour = response;},
   (error) => {console.log('Erreur ! : ' + error);});

 }

  ngOnInit() {
  }

}
