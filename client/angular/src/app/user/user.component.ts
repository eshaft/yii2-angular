import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Params, Router} from "@angular/router";

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {
  private id: number;
  private name: string;

  constructor(private router: Router, private activeRoute: ActivatedRoute) { }

  ngOnInit() {
    this.activeRoute.params.subscribe((params: Params) => this.id = params['id']);
    this.activeRoute.queryParams.subscribe((queryParams: Params) => this.name = queryParams['name']);
  }

  goHome(){
    this.router.navigate(['']);
  }
}
