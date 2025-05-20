import { Route, BrowserRouter as Router, Routes } from "react-router-dom";

import { QueryClientProvider, QueryClient } from "@tanstack/react-query";
import { StoreProvider } from "../store/StoreContext";
import DonorList from "./components/pages/developer/donor-list/DonorList";
import ChildrenList from "./components/pages/developer/children-list/ChildrenList";
import SettingsExperience from "./components/pages/developer/settings/experience/ExperienceList";
import ServiceList from "./components/pages/developer/settings/service/ServiceList";

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
            <Route path="/" element={<DonorList />} />
            <Route path="/donor" element={<DonorList />} />
            <Route
              path="/settings/experience"
              element={<SettingsExperience />}
            />
            <Route path="/settings/service" element={<ServiceList />} />
            <Route path="/children-list" element={<ChildrenList />} />
          </Routes>
        </Router>
      </StoreProvider>
    </QueryClientProvider>
  );
}
