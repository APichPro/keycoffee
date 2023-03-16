import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-form-search',
  templateUrl: './form-search.component.html',
  styleUrls: ['./form-search.component.css']
})

export class FormSearchComponent implements OnInit {
  valueRetour: any;
  userForm: FormGroup;
  afficheText: string;

  constructor(private fb: FormBuilder,private http: HttpClient) {  }

  ngAfterViewInit(){
    this.doGET();
  }
 
  ngOnInit() {
    this.userForm = this.fb.group({
      nom : [''],
      site : [''],
      typeUser : [''],
    });
  }

  register() {
    console.log(this.userForm.value);
    var formData: any = new FormData();
    formData.append("nom", this.userForm.value['nom']);
    formData.append("site", this.userForm.value['site']);
    formData.append("typeUser", this.userForm.value['typeUser']);
    this.http.get('http://prjsymf.cir3-frm-smf-ang-35/api/searchuser?nom=' + this.userForm.value['nom'] + '&site=' + this.userForm.value['site'] + '&typeUser=' + this.userForm.value['typeUser'] ,formData).subscribe((response) => {this.valueRetour = response;},
      (response) => console.log(response))
  }

  doGET() {

    console.log("GET");
    let url = `http://prjsymf.cir3-frm-smf-ang-35/api/listeuser`;
    //this.http.get(url).subscribe(res => console.log(res.json()));
    this.http.get<any[]>(url).subscribe((response) => {this.valueRetour = response;},
    (error) => {console.log('Erreur ! : ' + error);});
  }
}