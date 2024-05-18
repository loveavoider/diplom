import {useState} from "react";
import {Box, Button} from "@chakra-ui/react";
import axios from "axios";
import {API} from "@/app/constants";
import CreateForm from "@/app/components/CreateForm";
import NInput from "@/app/components/NInput";
import {getClientData} from "@/app/util/jurData";

export default function InnForm() {
    const [inn, setInn] = useState('');
    const [jurData, setJurData] = useState({});

    const defaultFormData = {has_prepaid: '1', type: '1', multi_lot: '1'};

    return (
        jurData?.value ?
            <CreateForm jurData={jurData} defaultFormData={defaultFormData} />
        : <Box display="flex" justifyContent="center">
                <Box mt="100px" width="30%" display="flex" justifyContent="center" flexWrap="wrap">
                    <NInput onChange={(e) => setInn(e.target.value)} placeholder='ИНН' />
                    <Button mt="16px" colorScheme="green" onClick={() => {
                        getClientData(inn, setJurData);
                    }}>
                        Принять
                    </Button>
                </Box>
            </Box>
    );
}