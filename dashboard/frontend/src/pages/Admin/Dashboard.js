import React from "react";
import RecentBlog from "../../components/Dashboard/RecentBlog";
import UpcomingEvents from "../../components/Dashboard/UpcomingEvents";
import "../../assets/css/dashboard/dashboard.css";
import { Container, Row, Col } from "reactstrap";

function Dashboard() {
  return (
    <div>
      {/* <div className="bkg header bg-gradient-info pl-5 pt-5 absolute"> */}
        {/* <span className="winhead">WINNERS</span> */}
      {/* </div> */}
      <Container fluid className="AllContent">
        <div className="content">
          {/* <Winner winners={winner} /> */}
          <Row className="pt-5">
            <Col xl="6">
              <h2 className="pb-3">PUBLISHED RECENTLY</h2>
              <RecentBlog />
            </Col>
            <Col xl="6">
              <h2 className="pb-3">UPCOMING EVENTS</h2>
              <UpcomingEvents />
            </Col>
          </Row>
        </div>
      </Container>
    </div>
  );
}

export default Dashboard;
