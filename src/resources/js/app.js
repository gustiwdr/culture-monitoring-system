import "./bootstrap";
import React from "react";
import { createRoot } from "react-dom/client";
import Dashboard from "./components/Dashboard";

const dashboardElement = document.getElementById("dashboard");
if (dashboardElement) {
    createRoot(dashboardElement).render(<Dashboard />);
}
