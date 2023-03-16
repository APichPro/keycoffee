import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailcleusersComponent } from './detailcleusers.component';

describe('DetailcleusersComponent', () => {
  let component: DetailcleusersComponent;
  let fixture: ComponentFixture<DetailcleusersComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetailcleusersComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailcleusersComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
