import { Route, BrowserRouter as Router, Routes } from "react-router-dom";

import { QueryClientProvider, QueryClient } from "@tanstack/react-query";
import { StoreProvider } from "../store/StoreContext";

import SettingsExperience from "./components/pages/developer/settings/experience/ExperienceList";
import ServiceList from "./components/pages/developer/settings/service/ServiceList";
import AboutList from "./components/pages/developer/about/AboutList";
import RecentWorkList from "./components/pages/developer/recent-work/RecentWorkList";
import MainServiceList from "./components/pages/developer/service/MainServiceList";
import MainExperienceList from "./components/pages/developer/experience/MainExperienceList";
import TestimonialsList from "./components/pages/developer/testimonials/TestimonialsList";

export default function App() {
  const queryClient = new QueryClient();

  return (
    <QueryClientProvider client={queryClient}>
      <StoreProvider>
        <Router>
          <Routes>
            <Route
              path="*"
              element={
                <div className="h-dvh w-dvh flex items-center justify-center">
                  <h3>Page Not Found.</h3>
                </div>
              }
            />

            <Route
              path="/settings/experience"
              element={<SettingsExperience />}
            />
            <Route path="/services" element={<MainServiceList />} />
            <Route path="/testimonials" element={<TestimonialsList />} />
            <Route path="/experience" element={<MainExperienceList />} />
            <Route path="/about" element={<AboutList />} />
            <Route path="/recent-work" element={<RecentWorkList />} />
            <Route path="/settings/service" element={<ServiceList />} />
          </Routes>
        </Router>
      </StoreProvider>
    </QueryClientProvider>
  );
}
