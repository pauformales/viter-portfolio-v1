import { useQuery } from "@tanstack/react-query";
import { queryData } from "./queryData";

const useQueryData = (
  endpoint,
  method,
  key = "",
  fd = {},
  id = null,
  refetchOnWindowFocus = false
) => {
  return useQuery({
    queryKey: [key, id],
    queryFn: async () => await queryData(endpoint, method, fd),
    retry: false,
    refetchOnWindowFocus: refetchOnWindowFocus,
    cacheTime: 200,
  });
};

export default useQueryData;
