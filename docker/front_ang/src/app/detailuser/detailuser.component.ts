import { Component, OnInit } from '@angular/core';
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'detailuser',
  templateUrl: './detailuser.component.html',
  styleUrls: ['./detailuser.component.css']
})

@Injectable()
export class DetailuserComponent implements OnInit {


  public id;


  constructor(private http: HttpClient, private route: ActivatedRoute){}
  valueRetour: any;
  //methode appelée à chaque appel du composant
  ngAfterViewInit(){

    this.doGET();
  }

  // methode réalisant l'appel au web service et insérant la réponse
  // dans une variable définie avant
  doGET() {
    //Recuperation de l'id dans l'URL
    let id = this.route.snapshot.paramMap.get('id');
    console.log("GET");
    let url = 'http://localhost:82/api/detailuser/' + id;
    //this.http.get(url).subscribe(res => console.log(res.json()));
    this.http.get<any[]>(url).subscribe((response) => {this.valueRetour = response;},
    (error) => {console.log('Erreur ! : ' + error);});

  }

  ngOnInit() {
  }

}
