import {Component, Input, OnInit} from '@angular/core';
import {Breadcrumb} from "./breadcrumb";

@Component({
  selector: 'breadcrumb',
  templateUrl: './breadcrumb.component.html',
  styleUrls: ['./breadcrumb.component.css']
})
export class BreadcrumbComponent implements OnInit {
  @Input() links: Breadcrumb[];

  constructor() { }

  ngOnInit() {
  }

}
